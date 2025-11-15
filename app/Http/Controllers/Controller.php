<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function uploadImage(Request $request, $name, $path)
    {
        if ($request->hasFile($name)) {
            return $request->file($name)->store('uploads/' . $path . '');
        }
    }

    public function unlinkFile($file)
    {
        if (file_exists($file)) {
            unlink($file);
        }
    }
}
