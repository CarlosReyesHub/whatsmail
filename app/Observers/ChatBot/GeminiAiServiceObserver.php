<?php

namespace App\Observers\ChatBot;

use Illuminate\Support\Facades\Http;

class GeminiAiServiceObserver
{
    public function getQuestionGemini(String $geminiKey, $message, $description, $conversations)
    {
        $messages = [];

        if ($description) {
            $messages[] = [
                'role'    => 'model',
                'content' => $description,
            ];
        }

        foreach ($conversations as $conversation) {
            $messages[] = [
                'role'    => 'user',
                'content' => $conversation->command,
            ];
            $messages[] = [
                'role'    => 'assistant',
                'content' => $conversation->answer,
            ];
        }

        $messages[] = [
            'role'    => 'user',
            'content' => $message,
        ];

        
        $formattedMessages = array_map(function ($message) {
            return [
                'role'  => $message['role'],
                'parts' => [
                    [
                        'text' => $message['content'],
                    ],
                ],
            ];
        }, $messages);
 
        return Http::withHeaders([
            'Content-Type'  => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$geminiKey}", [
            'contents' =>  $formattedMessages,
        ]);
    }
}
