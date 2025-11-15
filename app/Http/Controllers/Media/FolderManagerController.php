<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Media\Folder;
use App\Models\Media\MediaContent;
use App\Observers\Media\FolderObserver;
use App\Observers\Media\MediaObserver;
use Illuminate\Http\Request;

class FolderManagerController extends Controller
{
    protected $mediaObserver;
    protected $folderObserver;

    public function __construct(FolderObserver $folderObserver, MediaObserver $mediaObserver)
    {
        $this->folderObserver       = $folderObserver;
        $this->mediaObserver        = $mediaObserver;
    }


    public function index($path = null)
    {
        $folders = $path ? explode('/', $path) : [];

        $currentFolder = null;

        foreach ($folders as $folderSlug) {
            $currentFolder = Folder::where('slug', $folderSlug)
                ->where('folder_id', $currentFolder->id ?? null)
                ->firstOrFail();
        }

        $subFolders = $currentFolder ? $currentFolder->subs : Folder::whereNull('folder_id')->orderBy('name', 'asc')->get();
        $media = $currentFolder ? $currentFolder->media : [];

        return view('media.folder', [
            'current_folder' => $currentFolder,
            'sub_folders'    => $subFolders,
            'media'          => $media,
            'directory'      => $folders,
            'path'           => implode('/', $folders),
            'page'           => __('sidebar.media_manager'),
            'breadcumb'      => true,
        ]);
    }

    public function insertFolder(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|string',
            'folder_id'     => 'nullable'
        ]);

        $folder = $this->folderObserver->createData($request);

        $path = 'uploads/folders';

        if ($folder->parent) {
            $parentFolder       = $folder->parent;
            $folderHierarchy    = $this->buildFolderPath($parentFolder);
            $path .= '/' . implode('/', $folderHierarchy);
        }

        $path .= '/' . $folder->slug;

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        return redirect()->back()->with(['flash' => __('general.success_add_data')]);
    }

    public function insertMedia(Request $request)
    {
        $request->validate([
            'folder_id' => 'required|exists:folders,id',
            'file'      => 'required|mimes:png,jpg,jpeg,ogg,mp3,mp4,docx,xlsx,webp,pdf,csv,txt,ppt|max:10240',
        ]);

        $folder     = Folder::findOrFail($request->folder_id);
        $folderPath = $this->buildFolderPath($folder);
        $uploadPath = 'uploads/folders/' . implode('/', $folderPath);

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
 
        $file       = $request->file('file');
        $fileName   = time() . '_' . $file->getClientOriginalName();
        $extension  = $file->getClientOriginalExtension();
        $file->move($uploadPath, $fileName);

        $this->mediaObserver->createData($request, $fileName, $uploadPath . '/' . $fileName, $extension);
        return redirect()->back()->with(['flash' => __('general.success_add_data')]);
    }


    public function deleteMedia(MediaContent $media)
    {
        $this->unlinkFile($media->path);
        $media->delete();
        return redirect()->back()->with(['flash'    => __('general.success_deleted')]);
    }

    public function deleteFolder(Folder $folder)
    {
        try {

            foreach ($folder->media as $media) {
                $this->unlinkFile($media->path);
                $media->delete();
            }

            foreach ($folder->subs as $subFolder) {
                $this->deleteFolder($subFolder);
            }

            $folderPath = public_path('uploads/folders/' . $this->buildFolderPathTwo($folder));
            if (file_exists($folderPath)) {
                rmdir($folderPath);
            }

            $parentFolder = $folder->parent;
            $folder->delete();

            $redirectPath = $parentFolder
                ? route('folders', ['path' => $this->buildFolderPathTwo($parentFolder)])
                : route('folders');

            return redirect($redirectPath)->with(['flash' => __('general.success_deleted')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['gagal' => $e->getMessage() . ' - ' . $e->getLine()]);
        }
    }

    private function buildFolderPathTwo(Folder $folder)
    {
        $path = [];
        while ($folder) {
            $path[] = $folder->slug;
            $folder = $folder->parent;
        }
        return implode('/', array_reverse($path));
    }

    private function buildFolderPath($folder)
    {
        $path = [];
        while ($folder) {
            array_unshift($path, $folder->slug);
            $folder = $folder->parent;
        }
        return $path;
    }
}
