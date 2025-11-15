<?php

namespace App\Observers;

use App\Mail\NotificationEmail;
use App\Models\Master\MessageTemplate;
use App\Models\WhatsappDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class WhatsappServiceObserver
{
    public function createSession(WhatsappDevice $device)
    {
        return Http::post(env('WHATSAPP_SERVER_URL') . '/sessions/add', [
            'id'            => 'device_' . $device->id,
            'notification'  => $device->phone_notification == 'yes' ? false : true,
            'history'       => $device->chat_history == 'yes' ? true : false,
            'isLegacy' => false
        ]);
    }

    public function getContacts($session_id)
    {
        return Http::get(env('WHATSAPP_SERVER_URL') . "/chats/get-contacts?id={$session_id}");
    }

    public function getChats($session_id, $isGroup = false, $lastChat = null)
    {
        return Http::get(env('WHATSAPP_SERVER_URL') . "/chats?id={$session_id}&isgroup={$isGroup}&last_chat={$lastChat}");
    }

    public function getChatDetail($session_id, $chatID)
    {
        return Http::get(env('WHATSAPP_SERVER_URL') . '/chats/' . $chatID . '?id=' . $session_id);
    }

    public function deleteSession(WhatsappDevice $device)
    {
        return Http::delete(env('WHATSAPP_SERVER_URL') . '/sessions/delete/device_' . $device->id);
    }

    public function checkSession(WhatsappDevice $device)
    {
        return Http::get(env('WHATSAPP_SERVER_URL') . '/sessions/status/device_' . $device->id);
    }

    public function readMessages(Request $request, WhatsappDevice $device)
    {
        return Http::post(env('WHATSAPP_SERVER_URL') . '/chats/read-messages?id=device_' . $device->id, [
            'chatid'    => $request->chatid,
            'messages'  => $request->messages
        ]);
    }

    public function deleteMessage(Request $request, WhatsappDevice $device)
    {
        return Http::post(env('WHATSAPP_SERVER_URL') . '/chats/delete-message?id=device_' . $device->id, [
            'chatid'    => $request->chatid,
            'message'   => $request->message
        ]);
    }

    public function deleteEveryOne(Request $request, WhatsappDevice $device)
    {
        return Http::post(env('WHATSAPP_SERVER_URL') . '/chats/delete-everyone?id=device_' . $device->id, [
            'chatid'    => $request->chatid,
            'message'   => $request->message
        ]);
    }

    public function downloadMedia(Request $request, WhatsappDevice $device)
    {
        return Http::post(env('WHATSAPP_SERVER_URL') . '/chats/download-media?id=device_' . $device->id, [
            'type'      => $request->type,
            'medianame' => $request->medianame,
            'message'   => $request->message
        ]);
    }

    public function getPhotoProfile(Request $request, WhatsappDevice $device)
    {
        return Http::post(env('WHATSAPP_SERVER_URL') . '/chats/get-profile?id=device_' . $device->id, [
            'phone'     => $request->phone,
        ]);
    }

    public function markMessage(Request $request, WhatsappDevice $device)
    {
        return Http::post(env('WHATSAPP_SERVER_URL') . '/chats/mark-message?id=device_' . $device->id, [
            'status'    => $request->status,
            'chatid'    => $request->chatid
        ]);
    }

    public function deleteChats(Request $request, WhatsappDevice $device)
    {
        return Http::post(env('WHATSAPP_SERVER_URL') . '/chats/delete-chat?id=device_' . $device->id, [
            'chatid'     => $request->chatid,
        ]);
    }

    public function sendMessage($phone = null, $device, $message = '', String $file = '', $type = 'description', $dataArray = null, $isGroup = false)
    {

        try {

            $messageData    = $this->formatDataMessage($message, $file, $type, $dataArray); 
            $response = Http::post(env('WHATSAPP_SERVER_URL') . '/chats/send?id=' . 'device_' . $device, [
                'receiver'      => $phone,
                'delay'         => 1000,
                'isgroup'       => $isGroup,
                'message'       => $messageData
            ]);

            $status = $response->status();

            if ($status != 200) {
                $responseBody               = json_decode($response->body());
                $responseData['message']    = $responseBody->message;
                $responseData['status']     = $status;
            } else {
                $responseData['message']    = 'Berhasil mengirimkan pesan';
                $responseData['status']     = 200;
            }

            return $responseData;
        } catch (\Exception $e) {
            $responseData['status']     = 403;
            $responseData['message']    = $e->getMessage() . ' ' . $e->getLine();
            return $responseData;
        }
    }

    public function formatDataMessage($message = '', String $file = '', $type = 'description', $dataArray = null)
    {
        if ($type != 'location' && $type != 'vote') {
            if ($file != '') {
                $messageData['caption'] = $message;
            } else {
                $messageData['text']    = $message;
            }
        }


        if ($type == 'button') {
            $messageData['title']       = $dataArray != null && isset($dataArray['title']) ? $dataArray['title'] : '';
            $messageData['footer']      = $dataArray != null && isset($dataArray['footer']) ? $dataArray['footer'] : '';
            $messageData['headerType']  = 4;
            $messageData['viewOnce']    = true;

            $buttons        = [];
            $number         = 1;
            foreach ($dataArray['buttons'] as $key => $button) {
                $button_content['buttonId'] = 'id' . ($number++);
                $button_content['buttonText'] = array('displayText' => $button['button_name']);
                $button_content['type'] = 1;

                array_push($buttons, $button_content);
            }

            $messageData['buttons']     = $buttons;
        }

        if ($type == 'vote') {

            $result = array_map(function ($item) {
                return $item['name'];
            }, $dataArray['options']);

            $item['name']            = $dataArray != null && isset($dataArray['title']) ? $dataArray['title'] : '';
            $item['values']          = $result;
            $item['selectableCount'] = '1';

            $messageData['poll']    = $item;
        }

        if ($type == 'list') {
            $templateButtons = [];
            $messageData['title']       = $dataArray != null && isset($dataArray['title']) ? $dataArray['title'] : '';
            $messageData['footer']      = $dataArray != null && isset($dataArray['footer']) ? $dataArray['footer'] : '';
            $messageData['buttonText']  = $dataArray != null && isset($dataArray['button_name']) ? $dataArray['button_name'] : '';

            $numberKey  = 1;
            foreach ($dataArray['sections'] as $section_key => $sections) {
                $rows       = [];
                foreach ($sections['rows'] as $row_key => $r) {
                    $keyId                  = (int)$numberKey++;
                    $rowArr['title']        = $r['title'];
                    $rowArr['rowId']        = 'option-' . $keyId;
                    $rowArr['description']  = $r['description'];
                    array_push($rows, $rowArr);
                }


                $row['title']           = $sections['title'];
                $row['rows']            = $rows;

                array_push($templateButtons, $row);
                $row = [];
            }

            $messageData['sections']    = $templateButtons;
        }

        if ($type == 'location') {
            $messageData['location'] = array(
                'degreesLatitude'   => $dataArray != null && isset($dataArray['latitude']) ? $dataArray['latitude'] : '',
                'degreesLongitude'  => $dataArray != null && isset($dataArray['longitude']) ? $dataArray['longitude'] : ''
            );
        }


        if ($file != '') {
            $explode    = explode('.', $file);
            $file_type  = strtolower(end($explode));
            $extentions = [
                'jpg'       => 'image',
                'jpeg'      => 'image',
                'png'       => 'image',
                'webp'      => 'image',
                'pdf'       => 'document',
                'docx'      => 'document',
                'xlsx'      => 'document',
                'csv'       => 'document',
                'txt'       => 'document',
                'zip'       => 'document',
                'php'       => 'document',
                'css'       => 'document',
                'js'        => 'document',
                'html'      => 'document',
                'mp4'       => 'video',
                'ogg'       => 'audio',
                'mp3'       => 'audio',
                'ppt'       => 'document',
                'txt'       => 'documnt'
            ];

            $messageData[$extentions[$file_type]] = ['url' => $file, 'title' => rand()];
        }

        return $messageData;
    }

    public function sendEmail($email = null, $message = null, MessageTemplate $template)
    {

        try {

            if ($email != null) {
                Mail::to($email)->send(new NotificationEmail($message, $template));
            }

            return true;
        } catch (\Exception $e) {
            $responseData['status']     = 403;
            $responseData['message']    = $e->getMessage();
            return $responseData;
        }
    }
}
