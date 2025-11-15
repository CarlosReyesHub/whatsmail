<?php

namespace App\Observers\WhatsappOfficial;

use App\Models\Blash\BlashDetail;
use App\Models\Master\MessageTemplate;
use App\Models\Store\Store;
use App\Models\WhatsappKeyAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappOfficialServiceObserver
{

    public function sendMessageTemplate(Store $store, MessageTemplate $template, $variables)
    {
        $url = "https://graph.facebook.com/" . env('API_WABA_VERSION') . "/{$variables['phone_number']}/messages";

        $headers = $this->setHeaders($variables['access_token']);

        $requestData['messaging_product']   = 'whatsapp';
        $requestData['recipient_type']      = 'individual';
        $requestData['to']                  = $store->phone;
        $requestData['type']                = 'template';
        $requestData['template']            = $this->buildTemplateMessage($template);
        $responseObject                     = $this->sendHttpRequest('POST', $url, $requestData, $headers);

        dd($responseObject);
        if ($responseObject->success === true) {
        }

        return $responseObject;
    }

    function buildTemplateMessage(MessageTemplate $template)
    { 
        $templateDetails = json_decode($template->message, true);
 
        $reformattedTemplate = [
            'header'        => collect($templateDetails['components'])->firstWhere('type', 'HEADER') ? [
                'format'        => $templateDetails['components'][0]['format'] ?? null,
                'text'          => $templateDetails['components'][0]['text'] ?? null,
                'parameters'    => [],
            ] : null,
            'body'          => collect($templateDetails['components'])->firstWhere('type', 'BODY') ? [
                'text'          => $templateDetails['components'][1]['text'] ?? null,
                'parameters'    => [],
            ] : null,
            'footer'        => collect($templateDetails['components'])->firstWhere('type', 'FOOTER') ? [
                'text'          => $templateDetails['components'][2]['text'] ?? null,
            ] : null,
            'buttons'       => collect($templateDetails['components'])->firstWhere('type', 'BUTTONS')['buttons'] ?? [],
            'media'         => null, 
        ]; 
   
        return $reformattedTemplate;
    }



    public function getPhoneNumberId($accessToken, $wabaId)
    {

        $responseObject = new \stdClass();
        $fields         = 'display_phone_number,certificate,name_status,new_certificate,new_name_status,verified_name,quality_rating,messaging_limit_tier';
        $response       = Http::get("https://graph.facebook.com/v20.0/{$wabaId}/phone_numbers", [
            'fields'        => $fields,
            'access_token'  => $accessToken,
        ]);

        $callback   = $response->json();
        if ($response->status() != 200) {
            $responseObject->success = false;
            if (isset($callback['error'])) {

                $responseObject->data = new \stdClass();
                $responseObject->data->error = new \stdClass();
                $responseObject->data->error->code = $response->status();
                $responseObject->data->error->message = $callback['error']['message'];
            }
        } else {
            $responseObject->success = true;
            $responseObject->data = new \stdClass();
            $responseObject->data = (object) $callback['data'][0];
        }


        return $responseObject;
    }

    public function getPhoneNumberStatus($accessToken, $phoneNumberID)
    {
        $responseObject = new \stdClass();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken
        ])->get("https://graph.facebook.com/v20.0/{$phoneNumberID}", [
            'fields' => 'status',
        ]);

        $callback   = $response->json();
        if ($response->status() != 200) {
            $responseObject->success = false;
            if (isset($callback['error'])) {
                $responseObject->data = new \stdClass();
                $responseObject->data->error = new \stdClass();
                $responseObject->data->error->code = $response->status();
                $responseObject->data->error->message = $callback['error']['message'];
            }
        } else {
            $responseObject->success = true;
            $responseObject->data = new \stdClass();
            $responseObject->data = (object) $callback;
        }


        return $responseObject;
    }


    public function getAccountReviewStatus($accessToken, $wabaId)
    {
        $responseObject = new \stdClass();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken
        ])->get("https://graph.facebook.com/v20.0/{$wabaId}", [
            'fields' => 'account_review_status',
        ]);

        $callback   = $response->json();
        if ($response->status() != 200) {
            $responseObject->success = false;
            if (isset($callback['error'])) {
                $responseObject->data = new \stdClass();
                $responseObject->data->error = new \stdClass();
                $responseObject->data->error->code = $response->status();
                $responseObject->data->error->message = $callback['error']['message'];
            }
        } else {
            $responseObject->success = true;
            $responseObject->data = new \stdClass();
            $responseObject->data = (object) $callback;
        }

        return $responseObject;
    }

    public function getBusinessProfile($accessToken, $phoneNumberID)
    {
        $responseObject = new \stdClass();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken
        ])->get("https://graph.facebook.com/v20.0/{$phoneNumberID}/whatsapp_business_profile", [
            'fields' => 'about,address,description,email,profile_picture_url,websites,vertical',
        ]);

        $callback   = $response->json();
        if ($response->status() != 200) {
            $responseObject->success = false;
            if (isset($callback['error'])) {
                $responseObject->data = new \stdClass();
                $responseObject->data->error = new \stdClass();
                $responseObject->data->error->code = $response->status();
                $responseObject->data->error->message = $callback['error']['message'];
            }
        } else {
            $responseObject->success = true;
            $responseObject->data = new \stdClass();
            $responseObject->data = (object) $callback['data'][0];
        }

        return $responseObject;
    }

    public function updateBusinessProfile(Request $request)
    {
        $url        = "https://graph.facebook.com/" . env('API_WABA_VERSION') . "/{$request->phoneid}/whatsapp_business_profile";
        $headers    = $this->setHeaders($request->access_token);

        $requestData['messaging_product']   = 'whatsapp';
        $requestData['about']               = $request->about;
        $requestData['address']             = $request->address;
        $requestData['description']         = $request->description;
        $requestData['vertical']            = $request->industry;
        $requestData['email']               = $request->email;
        $responseObject                     = $this->sendHttpRequest('POST', $url, $requestData, $headers);

        if ($responseObject->success === true) {
            $organizationConfig = WhatsappKeyAccount::where('id', $this->organizationId)->first();
            $metadataArray = $organizationConfig->metadata ? json_decode($organizationConfig->metadata, true) : [];

            $metadataArray['whatsapp']['business_profile']['about'] = $request->about;
            $metadataArray['whatsapp']['business_profile']['address'] = $request->address;
            $metadataArray['whatsapp']['business_profile']['description'] = $request->description;
            $metadataArray['whatsapp']['business_profile']['industry'] = $request->industry;
            $metadataArray['whatsapp']['business_profile']['email'] = $request->email;

            $updatedMetadataJson = json_encode($metadataArray);

            $organizationConfig->metadata = $updatedMetadataJson;
            $organizationConfig->save();
        }

        return $responseObject;
    }


    //Set the headers for request
    public function setHeaders($accessToken)
    {
        return [
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ];
    }

    private function sendHttpRequest($method, $url, $data = [], $headers = [])
    {
        $responseObject = new \stdClass();

        // Tentukan metode HTTP yang didukung
        $httpClient = Http::withHeaders($headers);

        // Cek metode HTTP untuk menambahkan data jika perlu
        if (isset($data) && in_array($method, ['POST', 'PUT', 'DELETE'])) {
            $response = $httpClient->$method($url, $data);
        } else {
            $response = $httpClient->get($url);
        }

        if ($response->status() != 200) {
            $responseObject->success    = false;
            $responseObject->error      = $response->status();
            $responseObject->message    = $response->json()['error']['message'];
        } else {
            $responseObject->success = true;
            $responseObject->data = $response->json();
        }


        return $responseObject;
    }

    function syncTemplates($accessToken, $wabaId, WhatsappKeyAccount $device)
    {
        $url = "https://graph.facebook.com/" . env('API_WABA_VERSION') . "/{$wabaId}/message_templates";

        $responseObject = new \stdClass();

        $response   = Http::withHeaders([
            'Authorization' => "OAuth {$accessToken}",
        ])->get($url);

        if ($response->status() != 200) {
            $responseObject->success = false;
            $responseObject->message = $response->json()['error']['message'];
        } else {
            $responseObject->success = true;
            $responseObject->message = 'Berhasil sinkronkan data';

            foreach ($response->json()['data'] as $templateData) {
                $template = MessageTemplate::where("waba_device_id", $device->id)->where('meta_id', $templateData['id'])->first();

                if ($template) {
                    $template->update([
                        'message'               => json_encode($templateData),
                        'waba_status_template'  => $templateData['status'],
                        'for_waba'              => 'yes'
                    ]);
                } else {
                    MessageTemplate::create([
                        'for_waba'              => 'yes',
                        'waba_device_id'        => $device->id,
                        'meta_id'               => $templateData['id'],
                        'name'                  => $templateData['name'],
                        'category'              => $templateData['category'],
                        'lang'                  => $templateData['language'],
                        'message'               => json_encode($templateData),
                        'waba_status_template'  => $templateData['status'],
                        'created_by'            => auth()->user()->id,
                    ]);
                }
            }
        }

        return $responseObject;
    }

    function unSubscribeToWaba($wabaId, $accessToken)
    {
        $url                = "https://graph.facebook.com/" . env('API_WABA_VERSION') . "/{$wabaId}/subscribed_apps";
        $headers            = $this->setHeaders($accessToken);
        $responseObject     = $this->sendHttpRequest('DELETE', $url, NULL, $headers);

        return $responseObject;
    }


    public function sendTemplateMessage(Store $store, $templateContent, $variablesData = [])
    {  
        $url = "https://graph.facebook.com/".env('API_WABA_VERSION')."/{$variablesData['phoneid']}/messages";
        
        $headers = $this->setHeaders($variablesData['access_token']);

        $requestData['messaging_product']   = 'whatsapp';
        $requestData['recipient_type']      = 'individual';
        $requestData['to']                  = $store->phone;
        $requestData['type']                = 'template';
        $requestData['template']            = $templateContent;

        $responseObject = $this->sendHttpRequest('POST', $url, $requestData, $headers);
 
        if($responseObject->success === true){
             $response['status']      = 200;
             $response['message']     = 'success';
        } else { 
            $response['status']      = $responseObject->error;
            $response['message']     = $responseObject->message;
        }

        return $response;
    }
}
