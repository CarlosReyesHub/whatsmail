<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatBot\ChatBot;
use App\Models\Setting;
use App\Models\WhatsappDevice;
use App\Observers\ChatBot\GeminiAiServiceObserver;
use App\Observers\ChatBot\OpenAiServiceObserver;
use App\Observers\WhatsappServiceObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappCallbackController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Whatsapp Callback Api Controller
    |--------------------------------------------------------------------------
    */

    protected $openAiServiceObserver;
    protected $whatsappServiceObserver;
    protected $geminiAiServiceObserver;

    public function __construct(OpenAiServiceObserver $openAiServiceObserver, WhatsappServiceObserver $whatsappServiceObserver, GeminiAiServiceObserver $geminiAiServiceObserver)
    {
        $this->openAiServiceObserver        = $openAiServiceObserver;
        $this->whatsappServiceObserver      = $whatsappServiceObserver;
        $this->geminiAiServiceObserver      = $geminiAiServiceObserver;
    }

    /*
    |--------------------------------------------------------------------------
    | 1. Whatsapp Callback / Webhook
    |--------------------------------------------------------------------------
    */

    public function callBackWhatsapp(Request $request, $device_id)
    {

        $session        = $device_id;
        $device_id      = str_replace('device_', '', $device_id);
        $device         = WhatsappDevice::find($device_id);
        $request_from   = explode('@', $request->from);
        $fromType       = $request_from[1] == 'g.us' ? 'group' : 'personal';


        $message        = $request->message ?? null;
        $device_id      = $device_id;

        if ($device != null && $message != null) {
            if (($device->auto_reply_option == 'group' && $fromType == 'personal') || ($device->auto_reply_option == 'personal' && $fromType == 'group')) {
                return response()->json([
                    'message'       => array('text' => null),
                    'receiver'      => $request->from,
                    'session_id'    => $session,
                    'autoread'      => $device->auto_read_before_autorespon == 'yes' ? true : false,
                    'reply'         => false,
                ], 200);
            }


            if ($device->daily_limit == 'yes') {
                if ($device->daily_send >= $device->limit_per_day) {
                    return response()->json([
                        'message'       => array('text' => null),
                        'receiver'      => $request->from,
                        'session_id'    => $session,
                        'autoread'      => $device->auto_read_before_autorespon == 'yes' ? true : false,
                        'reply'         => false,
                    ], 200);
                }
            }

            // Checking Fpr Days and Time
            $checkingDaysAndTime = $this->checkingTimeAutoReply($device);

            if ($checkingDaysAndTime == true) {

                // Auto Reply With ChatBot
                if ($device->auto_reply_method == 'chatbot' || $device->auto_reply_method == 'all') {
                    $reply  = $this->autoReplyMessage($device, $message, $request->from_name, $request_from[0], $fromType);
                    if ($reply['status'] == true) {
                        return response()->json([
                            'message'       => $reply['message'],
                            'receiver'      => $request->from,
                            'session_id'    => $session,
                            'autoread'      => $device->auto_read_before_autorespon == 'yes' ? true : false,
                            'reply'         => true,
                        ], 200);
                    }
                }

                // Auto Reply With Ai
                if ($device->auto_reply_method == 'ai' || $device->auto_reply_method == 'all') {
                    $reply  = $this->aiReply($device, $message, $request_from[0], $fromType);
                    if ($reply['status'] == true) {
                        return response()->json([
                            'message'       => array('text' => $reply['message']),
                            'receiver'      => $request->from,
                            'session_id'    => $session,
                            'autoread'      => $device->auto_read_before_autorespon == 'yes' ? true : false,
                            'reply'         => true
                        ], 200);
                    }
                }
            }

            if ($device->webhook != null && $device->webhook != '') {
                $this->sendCustomWebHook($request, $device);
            }
        }

        if ($device->reply_any_chat == 'yes') {
            $reply  = $this->anyAutoReply($device, $request->from_name);
            if ($reply['status'] == true) {
                return response()->json([
                    'message'       => $reply['message'],
                    'receiver'      => $request->from,
                    'session_id'    => $session,
                    'autoread'      => $device->auto_read_before_autorespon == 'yes' ? true : false,
                    'reply'         => true,
                ], 200);
            }
        }


        return response()->json([
            'message'       => array('text' => null),
            'receiver'      => '',
            'session_id'    => $session,
            'autoread'      => false,
            'reply'         => false
        ], 200);
    }


    /*
    |--------------------------------------------------------------------------
    | 2. Validation For Auto Reply Days and Time
    |--------------------------------------------------------------------------
    */

    public function checkingTimeAutoReply(WhatsappDevice $device)
    {

        /**
         * Check For Activation Days 
         */

        if ($device->auto_reply_certain_day == 'yes') {
            if ($device->days != null) {
                $day        = date("D");
                $getVoucher = WhatsappDevice::where("id", $device->id)->whereRaw("find_in_set('" .  $day . "',days)")->count(); // Check Day in This Auto Reply

                // If Auto Reply Not Active for this day
                if ($getVoucher == 0) {
                    return false;
                }
            }
        }


        /**
         * Checking For Activation Time
         */

        if ($device->auto_reply_certain_time == 'yes') {
            if ($device->start_time != null) {
                if ($device->start_time > date("H:i")) {
                    return false;
                }

                if ($device->end_time < date("H:i")) {
                    return false;
                }
            }
        }


        return true;
    }


    /*
    |--------------------------------------------------------------------------
    | 3. Whatsapp Message For Use Auto Reply
    |--------------------------------------------------------------------------
    */

    public function autoReplyMessage(WhatsappDevice $device, $message, $name = '', $from, $type = 'personal')
    {
        $chatBot = ChatBot::whereRaw("find_in_set('" .  $device->id . "',select_device)")->with('template')
            ->where('keyword', 'like', '%' . preg_quote($message) . '%')->first();


        if (!$chatBot) {
            return array(
                'status'    => false,
                'message'   => null
            );
        }

        if ($chatBot->reply_method == 'text') {
            return array(
                'status'    => true,
                'message'   => array(
                    'text'      => $chatBot->message
                )
            );
        }

        if ($chatBot->reply_method == 'template') {

            $file           = $chatBot->template->image != null ? asset($chatBot->template->image) : '';
            $messageText    = $chatBot->template->message ?? '';
            $messageData    = $this->whatsappServiceObserver->formatDataMessage($messageText, $file, $chatBot->template->type_content, json_decode($chatBot->template->button_or_list, true));
            return array(
                'status'    => true,
                'message'   => $messageData
            );
        }

        if ($chatBot->reply_method == 'image') {
            foreach ($chatBot->details as $detail) {
                $this->whatsappServiceObserver->sendMessage($from, $device->id, $detail->name ?? '', $detail->url, 'description', null, ($type == 'personal' ? false : true));
            }

            return array(
                'status'    => true,
                'message'   => array(
                    'text'      => ''
                )
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | 4. Ai Reply
    |--------------------------------------------------------------------------
    */

    public function aiReply(WhatsappDevice $device, $message, $from, $type = 'personal')
    {
        // Checking FineTunnel is Ready
        if (!$device->finetunnel) {
            return array(
                'status'    => false,
                'message'   => null
            );
        }

        $settings       = Setting::where('merchant_id', $device->merchant_id)->first(['open_ai_key', 'ai_option']);
        $fineTunnel     = $device->finetunnel;

        // if ($fineTunnel->fine_tunnel_id != null) {
        //     $response   = $this->openAiServiceObserver->getFileTun($fineTunnel, $settings->open_ai_key);
        //     if ($response->status() == 200) {
        //         $responseBody   = json_decode($response->body());

        //         if ($responseBody->status == 'succeeded') {
        //             $response   = $this->openAiServiceObserver->getAskWithTunnel($fineTunnel, $settings->open_ai_key, $message);
        //             if ($response->status() == 200) {
        //                 $responseBody   = json_decode($response->body());
        //                 if (isset($responseBody->choices[0])) {
        //                     return array(
        //                         'status'    => true,
        //                         'message'   => $responseBody->choices[0]->message->content
        //                     );
        //                 }
        //             }
        //         }
        //     }
        // }

        $conversations  = $fineTunnel->details;
        $response       = null;
        if ($settings->ai_option == 'chatgpt') {
            $result       = $this->openAiServiceObserver->getQuestion($settings->open_ai_key, $message, ($fineTunnel->description ?? ''), $conversations);
            if ($result->status() == 200) {
                $responseBody   = json_decode($result->body());
                if (isset($responseBody->choices[0])) {
                    $response   = $responseBody->choices[0]->message->content;
                }
            }
        }

        if ($settings->ai_option == 'gemini') {
            $result       = $this->geminiAiServiceObserver->getQuestionGemini($settings->open_ai_key, $message, ($fineTunnel->description ?? ''), $conversations);
            if ($result->status() == 200) {
                $responseBody = json_decode($result->body());
                if (isset($responseBody->candidates[0]->content->parts[0]->text)) {
                    $response = $responseBody->candidates[0]->content->parts[0]->text;
                }
            }
        }


        if ($response != null) {

            preg_match_all('/https?:\/\/[^\s)]+/i', $response, $matches);

            $urls = $matches[0] ?? [];
 
            foreach ($urls as $url) {
                if ($this->isImageUrl($url)) {
                    $this->whatsappServiceObserver->sendMessage(
                        $from,
                        $device->id,
                        '',
                        $url,
                        'description',
                        null,
                        ($type == 'personal' ? false : true)
                    );
                }
            }

            return array(
                'status'    => true,
                'message'   => $response
            );
        }


        return array(
            'status'    => false,
            'message'   => null
        );
    }

    /*
    |--------------------------------------------------------------------------
    | 5. Any Auto Reply
    |--------------------------------------------------------------------------
    */

    public function anyAutoReply(WhatsappDevice $device, $name)
    {

        if ($device->reply_method == 'text') {

            $message = str_replace(
                ['{whatsapp_name}'],
                [$name],
                $device->reply_text
            );

            return array(
                'status'    => true,
                'message'   => array(
                    'text'      => $message
                )
            );
        }

        if ($device->reply_method == 'template') {

            $file           = $device->template->image != null ? asset($device->template->image) : '';
            $messageText    = $device->template->text ?? '';
            $messageData    = $this->whatsappServiceObserver->formatDataMessage($messageText, $file, $device->template->type_content, json_decode($device->template->button_or_list, true));
            return array(
                'status'    => true,
                'message'   => $messageData
            );
        }
    }

    public function sendCustomWebHook(Request $request, WhatsappDevice $device)
    {

        $request_from   = explode('@', $request->from);
        $request_from   = $request_from[0];

        return Http::accept('application/json')->post($device->webhook, [
            'device_key'    => $device->id,
            'name'          => $request->from_name,
            'from'          => $request_from,
            'message'       => $request->message,
            'type'          => $request->type
        ]);
    }

    private function isImageUrl($url)
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $pathInfo = pathinfo(parse_url($url, PHP_URL_PATH));
        return isset($pathInfo['extension']) && in_array(strtolower($pathInfo['extension']), $imageExtensions);
    }
}
