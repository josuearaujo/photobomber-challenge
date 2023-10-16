<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index() {
        $photos = Photo::whereUserId(auth()->user()->id)->get();
    
        return Inertia::render('Gallery/List', [
            'photos' => $photos,
            'photoCount' => $photos->count(),
        ]);
    }

    public function show($id) {
        $photo = Photo::find($id);

        $filePath = Storage::path($photo->path);
    
        return response()->file($filePath);
    }

    public function destroy($id) {
        $photo = Photo::find($id);

        $filePath = Storage::delete($photo->path);

        $photos = Photo::whereUserId(auth()->user()->id)->get();
    
        return Inertia::render('Gallery/List', [
            'photos' => $photos,
            'photoCount' => $photos->count(),
        ]);
    }
}
