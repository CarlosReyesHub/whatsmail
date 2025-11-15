<?php

namespace App\Observers\ChatBot;

use App\Models\ChatBot\FineTunnel;
use Illuminate\Support\Facades\Http;

class OpenAiServiceObserver
{


    public function getQuestion(String $openAiKey, $message, $description, $conversations)
    {

        $messages   = [];

        if ($description) {
            $messages[] = [
                'role'      => 'system',
                'content'   => $description,
            ];
        }

        foreach($conversations as $conversation) {
            $messages[] = [
                'role'      => 'user',
                'content'   => $conversation->command,
            ];
            $messages[] = [
                'role'      => 'assistant',
                'content'   => $conversation->answer,
            ];
        }

        $messages[] = [
            'role'      => 'user',
            'content'   => $message,
        ];
 
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $openAiKey,
            'Content-Type'  => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model'             => 'gpt-4',
            'messages'          => $messages,
        ]);
    }


    public function getFileTun(FineTunnel $fineTunnel, String $openAiKey)
    {
        return Http::withHeaders([
            'Authorization' => "Bearer $openAiKey",
        ])->get('https://api.openai.com/v1/files/' . $fineTunnel->fine_tunnel_id);
    }

    public function deleteFileTun(FineTunnel $fineTunnel, String $openAiKey)
    {
        return Http::withHeaders([
            'Authorization' => "Bearer $openAiKey",
        ])->delete('https://api.openai.com/v1/files/' . $fineTunnel->fine_tunnel_id);
    }

    public function uploadFileTune(FineTunnel $fineTunnel, String $openAiKey, String $jsonName)
    {
        return Http::withHeaders([
            'Authorization' => "Bearer $openAiKey",
        ])->attach(
            'file',
            file_get_contents($fineTunnel->filejson),
            '' . $jsonName . ''
        )->post('https://api.openai.com/v1/files', [
            'purpose' => 'fine-tune',
        ]);
    }

    public function getAskWithTunnel(FineTunnel $fineTunnel, String $openAiKey, $message)
    {
        return Http::withHeaders([
            'Authorization'     => "Bearer $openAiKey",
            'Content-Type'      => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => $fineTunnel->fine_tunnel_id,
            'messages' => [
                ['role' => 'user', 'content' => $message]
            ],
        ]);
    }


    public function fineTunnelProcess(FineTunnel $fineTunnel, String $openAiKey)
    {
        return Http::withHeaders([
            'Authorization'     => "Bearer $openAiKey",
            'Content-Type'      => 'application/json',
        ])->post('https://api.openai.com/v1/fine_tunes', [
            'training_file' => $fineTunnel->fine_tunnel_id,
            'model' => 'gpt-4o-mini'
        ]);
    }
}
