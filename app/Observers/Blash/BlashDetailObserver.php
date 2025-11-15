<?php

namespace App\Observers\Blash;

use App\Models\Blash\BlashDetail;
use App\Models\Blash\BlashWhatsapp;
use Illuminate\Http\Request;

class BlashDetailObserver
{

   

    public function getData(Request $request, BlashWhatsapp $blash)
    {
        return BlashDetail::where("blash_whatsapp_id", $blash->id)->whereHas('store', function ($q) use ($request) {
            return $request->name ? $q->where('name', 'like', '%' . $request->name . '%') : '';
        })->orderBy('created_at', 'desc');
    }
}
