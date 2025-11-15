<?php

namespace App\Observers\WhatsappOfficial;

use App\Models\WhatsappKeyAccount;
use Illuminate\Http\Request;

class WhatsappOfficialObserver
{
    public function getData(Request $request)
    {
        return WhatsappKeyAccount::where(function ($q) use ($request) {
            return $request->phone ? $q->where('phone', 'like', '%' . $request->phone . '%') : '';
        })->where(function ($q) use ($request) {
            return $request->limit ? ($request->limit == 'limit' ? $q->whereRaw('daily_send >= limit_per_day') : $q->whereRaw('daily_send < limit_per_day')->orWhere("daily_limit", "no")) : '';
        })->orderBy('phone', 'asc');
    }

    public function checkLimit()
    {
        if (auth()->user()->role == 'user') {
            $transaction = auth()->user()->merchant->package_active;
            if (!$transaction) {
                return false;
            }


            if ($transaction->limit_device == 'yes') {
                $allDevices = WhatsappKeyAccount::count();
                if ($allDevices >= $transaction->device_limit) {
                    return false;
                }
            }
        }


        return true;
    }

    public function createData(Request $request, $metaData)
    {
        return WhatsappKeyAccount::create([
            'meta_data'             => $metaData,
            'phone'                 => $request->phoneid,
            'status'                => 'active'
        ]);
    }

    public function updateData(Request $request, WhatsappKeyAccount $device)
    {
        $device->update([ 
            'limit_per_day'         => $request->daily_limit == 'yes' ? $request->limit : 0,
            'auto_reply_method'     => $request->method,
            'fine_tunnel_id'        => $request->method == 'ai' ? $request->tunnel : null, 
            'auto_reply_certain_day'    => $request->certain_day,
            'days'                      => $request->certain_day == 'yes' ? implode(',', $request->days) : null,
            'auto_reply_certain_time'   => $request->certain_time,
            'start_time'                => $request->certain_time == 'yes' ? $request->start_time : null,
            'end_time'                  => $request->certain_time == 'yes' ? $request->end_time : null, 
            'auto_read_before_autorespon'       => $request->auto_read_chatbot,
            'auto_reply_option'                 => $request->auto_reply_option
        ]);
    }

    public function deleteData(WhatsappKeyAccount $device)
    {
        $device->delete();
    }

    public function setAutoReply(WhatsappKeyAccount $whatsapp, Request $request)
    {
        $whatsapp->update([
            'reply_any_chat'            => $request->reply_chat,
            'reply_method'              => $request->reply_method,
            'template_id'               => $request->reply_method == 'template' ? $request->reply_template : null,
            'reply_text'                => $request->reply_method == 'text' ? $request->reply_text : null
        ]);
    }

    public function setWebookAndLimit(WhatsappKeyAccount $device, Request $request)
    {

        $device->update([ 
            'daily_limit'               => $request->daily_limit,
            'limit_per_day'             => $request->daily_limit == 'yes' ? $request->limit : 0,
            'webhook'                   => $request->webhook,
        ]);
    }
}
