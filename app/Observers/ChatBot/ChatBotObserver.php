<?php

namespace App\Observers\ChatBot;

use App\Models\ChatBot\ChatBot;
use App\Models\ChatBot\ChatBotImage;
use Illuminate\Http\Request;

class ChatBotObserver
{

    public function getData(Request $request)
    {
        return ChatBot::where(function ($q) use ($request) {
            return $request->keyword ? $q->where('keyword', 'like', '%' . $request->keyword . '%') : '';
        })->orderBy('created_at', 'desc');
    }

    public function checkLimit()
    {
        if (auth()->user()->role == 'user') {
            $transaction = auth()->user()->merchant->package_active;
            if (!$transaction) {
                return false;
            }

            if ($transaction->limit_chatbot == 'yes') {
                $allChatBots = ChatBot::count();
                if ($allChatBots >= $transaction->chatbot_limit) {
                    return false;
                }
            }
        }


        return true;
    }

    public function createData(Request $request)
    {
        return ChatBot::create([
            'keyword'           => $request->keyword,
            'select_device'     => implode(",", $request->device),
            'reply_method'      => $request->method,
            'template_id'       => $request->method == 'template' ? $request->template : null,
            'message'           => $request->method == 'text' ? $request->message : null
        ]);
    }

    public function updateData(Request $request, ChatBot $bot)
    {
        $bot->update([
            'keyword'           => $request->keyword,
            'select_device'     => implode(",", $request->device),
            'reply_method'      => $request->method,
            'template_id'       => $request->method == 'template' ? $request->template : null,
            'message'           => $request->method == 'text' ? $request->message : null
        ]);
    }

    public function deleteData(ChatBot $bot)
    {
        return $bot->delete();
    }

    public function createImages(Request $request, ChatBot $chatBot)
    {
        $chatBot->details()->delete();

        if (isset($request->url)) {
            $i = 0;
            while ($i < count($request->url)) {
                ChatBotImage::create([
                    'chatbot_id'     => $chatBot->id,
                    'url'            => $request->url[$i],
                    'name'           => $request->name[$i] ?? null
                ]);
                $i++;
            }
        }
    }
}
