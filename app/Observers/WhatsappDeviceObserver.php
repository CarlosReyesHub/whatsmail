<?php

namespace App\Observers;

use App\Models\WhatsappDevice;
use Illuminate\Http\Request;

class WhatsappDeviceObserver
{
    public function getData(Request $request)
    {
        return WhatsappDevice::where(function ($q) use ($request) {
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
                $allDevices = WhatsappDevice::count();
                if ($allDevices >= $transaction->device_limit) {
                    return false;
                }
            }
        }


        return true;
    }

    public function createData(Request $request)
    {
        return WhatsappDevice::create([
            'name'                  => $request->name,
            'phone'                 => $request->phone,
            'phone_notification'    => $request->notification,
            'chat_history'          => $request->chat_history,
            'limit_per_day'         => $request->daily_limit == 'yes' ? $request->limit : 0,
            'auto_reply_method'     => $request->method,
            'fine_tunnel_id'        => $request->method == 'ai' || $request->method == 'all' ? $request->tunnel : null,
            'daily_limit'               => $request->daily_limit,
            'auto_reply_certain_day'    => $request->certain_day,
            'days'                      => $request->certain_day == 'yes' ? implode(',', $request->days) : null,
            'auto_reply_certain_time'   => $request->certain_time,
            'start_time'                => $request->certain_time == 'yes' ? $request->start_time : null,
            'end_time'                  => $request->certain_time == 'yes' ? $request->end_time : null,
            'webhook'                   => $request->webhook,
            'auto_read_before_autorespon'       => $request->auto_read_chatbot,
            'auto_read_in_chattapp'     => $request->auto_read_chattapp,
            'auto_reply_option'         => $request->auto_reply_option
        ]);
    }

    public function updateData(Request $request, WhatsappDevice $device)
    {
        $device->update([
            'name'                  => $request->name,
            'limit_per_day'         => $request->daily_limit == 'yes' ? $request->limit : 0,
            'auto_reply_method'     => $request->method,
            'fine_tunnel_id'        => $request->method == 'ai' || $request->method == 'all' ? $request->tunnel : null,
            'daily_limit'               => $request->daily_limit,
            'auto_reply_certain_day'    => $request->certain_day,
            'days'                      => $request->certain_day == 'yes' ? implode(',', $request->days) : null,
            'auto_reply_certain_time'   => $request->certain_time,
            'start_time'                => $request->certain_time == 'yes' ? $request->start_time : null,
            'end_time'                  => $request->certain_time == 'yes' ? $request->end_time : null,
            'webhook'                   => $request->webhook,
            'auto_read_before_autorespon'       => $request->auto_read_chatbot,
            'auto_read_in_chattapp'     => $request->auto_read_chattapp,
            'auto_reply_option'         => $request->auto_reply_option
        ]);
    }

    public function deleteData(WhatsappDevice $device)
    {
        $device->delete();
    }

    public function setAutoReply(WhatsappDevice $whatsapp, Request $request)
    {
        $whatsapp->update([
            'reply_any_chat'            => $request->reply_chat,
            'reply_method'              => $request->reply_method,
            'template_id'               => $request->reply_method == 'template' ? $request->reply_template : null,
            'reply_text'                => $request->reply_method == 'text' ? $request->reply_text : null
        ]);
    }
}
