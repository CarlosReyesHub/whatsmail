<?php

namespace App\Observers\ChatBot;

use App\Models\ChatBot\FineTunnel;
use App\Models\ChatBot\FineTunnelDetail;
use Illuminate\Http\Request;

class FineTunnelObserver
{

    public function getData(Request $request)
    {
        return FineTunnel::where(function ($q) use ($request) {
            return $request->name ? $q->where('name', 'like', '%' . $request->name . '%') : '';
        })->orderBy('name', 'asc');
    }

    public function checkLimit()
    {
        if (auth()->user()->role == 'user') {
            $transaction = auth()->user()->merchant->package_active;
            if (!$transaction) {
                return false;
            }

            if ($transaction->limit_ai_training == 'yes') {
                $allTrainings = FineTunnel::count();
                if ($allTrainings >= $transaction->ai_training_limit) {
                    return false;
                }
            }
        }


        return true;
    }

    public function createData(Request $request, $description)
    {
        return FineTunnel::create([
            'name'              => $request->name,
            'method'            => $request->method,
            'url'               => $request->method == 'website' ? $request->url : null,
            'description'       => $description,
            'option_audio_to_text_ai'       => $request->option_audio_to_text_ai,
            'min_audio'                     => $request->option_audio_to_text_ai == 'yes' ? $request->min_audio : 0
        ]);
    }

    public function createDetails(Request $request, FineTunnel $fineTunnel)
    {
        $fineTunnel->details()->delete();

        if (isset($request->command)) {
            $i  = 0;
            while ($i < count($request->command)) {
                FineTunnelDetail::create([
                    'fine_tunnel_id'    => $fineTunnel->id,
                    'command'           => $request->command[$i],
                    'answer'            => $request->answer[$i]
                ]);

                $i++;
            }
        }
    }

    public function updateData(Request $request, FineTunnel $fineTunnel, $description)
    {
        $fineTunnel->update([
            'name'              => $request->name,
            'method'            => $request->method,
            'url'               => $request->method == 'website' ? $request->url : null,
            'description'       => $description,
            'status'            => 'before_upload',
            'option_audio_to_text_ai'       => $request->option_audio_to_text_ai,
            'min_audio'                     => $request->option_audio_to_text_ai == 'yes' ? $request->min_audio : 0
        ]);
    }

    public function deleteData(FineTunnel $fineTunnel)
    {
        $fineTunnel->details()->delete();
        return $fineTunnel->delete();
    }
}
