<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Models\Photo;
use Inertia\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PhotoController extends Controller
{
    public function index(): Response
    {
        $photos = Photo::whereUserId(auth()->user()->id)->get();

        return Inertia::render('Gallery/List', [
            'photos' => $photos,
            'photoCount' => $photos->count(),
        ]);
    }

    public function show($id): BinaryFileResponse
    {
        $photo = Photo::where($id);

        $filePath = Storage::path($photo->path);

        return response()->file($filePath);
    }

    public function destroy($id): Response
    {
        $photo = Photo::where($id);

        Storage::delete($photo->path);

        $photos = Photo::whereUserId(auth()->user()->id)->get();

        return Inertia::render('Gallery/List', [
            'photos' => $photos,
            'photoCount' => $photos->count(),
        ]);
    }
}
