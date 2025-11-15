<?php

namespace App\Observers\Media;

use App\Models\Media\Folder;
use Illuminate\Http\Request;

class FolderObserver
{
    public function createData(Request $request)
    {
      return  Folder::create([
            'name'      => $request->name,
            'folder_id' => $request->folder_id
        ]);
    }
}
