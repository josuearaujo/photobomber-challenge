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
        $user = auth()->user();
        $token = $user->createToken('all');

        $photos = Photo::whereUserId($user->id)->orderByDesc('created_at')->get();

        return Inertia::render('Gallery/List', [
            'photos' => $photos,
            'token' => $token->plainTextToken
        ]);
    }

    public function show(int $id): BinaryFileResponse
    {
        $photo = Photo::whereId($id)->first();

        $filePath = Storage::path($photo->path);

        return response()->file($filePath);
    }

    public function destroy(int $id): Response
    {
        $photo = Photo::whereId($id)->first();

        Storage::delete($photo->path);
        $photo->delete();

        $photos = Photo::whereUserId(auth()->user()->id)->get();

        return Inertia::render('Gallery/List', [
            'photos' => $photos,
            'photoCount' => $photos->count(),
        ]);
    }
}
