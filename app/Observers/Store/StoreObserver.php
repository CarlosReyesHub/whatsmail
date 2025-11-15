<?php

namespace App\Observers\Store;

use App\Models\Store\Store;
use Illuminate\Http\Request;

class StoreObserver
{
    public function getData(Request $request)
    {
        return Store::where(function ($q) use ($request) {
            return $request->name ? $q->where('name', 'like', '%' . $request->name . '%') : '';
        })->where(function ($q) use ($request) {
            return $request->category ? $q->where("category_id", $request->category) : '';
        })->where(function ($q) use ($request) {
            return $request->district ? $q->where("district_id", $request->district) : '';
        })->where(function ($q) use ($request) {
            return $request->status ? $q->where("status", $request->status) : '';
        })->orderBy('name', 'asc');
    }

    public function createData(Request $request)
    {
        return Store::create([
            'category_id'           => $request->category,
            'district_id'           => $request->district,
            'name'                  => $request->name,
            'phone'                 => $request->phone,
            'email'                 => $request->email,
            'address'               => $request->address,
        ]);
    }

    public function updateData(Request $request, Store $store)
    {
        $store->update([
            'category_id'           => $request->category,
            'district_id'           => $request->district,
            'name'                  => $request->name,
            'phone'                 => $request->phone,
            'email'                 => $request->email,
            'address'               => $request->address,
            'status'                => $request->status
        ]);
    }

    public function deleteData(Store $store)
    {
        $store->delete();
    }
}
