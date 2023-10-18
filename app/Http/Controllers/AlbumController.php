<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbumRequest;
use App\Models\Album;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class AlbumController extends Controller
{
    public function index(): Response
    {
        $user = auth()->user();
        $token = $user->createToken('all');

        $albums = Album::whereUserId($user->id)->with('photos')->orderByDesc('created_at')->get();

        return Inertia::render('Photobook/List', [
            'albums' => $albums,
            'token' => $token->plainTextToken
        ]);
    }

    public function store(StoreAlbumRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = auth()->user();

        $album = $user->albums()->create([
            'title' => data_get($validated, 'title'),
            'description' => data_get($validated, 'description'),
            'layout' => data_get($validated, 'layout')
        ]);

        return redirect()->route('photobook.show', ['id' => $album->id]);
    }

    public function show(int $id): Response
    {
        $album = Album::whereId($id)->first();
        $user = auth()->user();
        $token = $user->createToken('all');

        return Inertia::render('Photobook/Show', [
            'album' => $album,
            'albumPhotos' => $album->photos,
            'userPhotos' => $user->photos,
            'token' => $token->plainTextToken,
        ]);
    }

    public function destroy(int $id)
    {

    }

    public function addPhoto(int $albumId, int $photoId): \Illuminate\Contracts\Foundation\Application|ResponseFactory|Application|\Illuminate\Http\Response
    {
        Album::whereId($albumId)->first()->photos()->attach($photoId);

        return response(["albumId" => $albumId, 'photoId' => $photoId, "attached" => true], 200);
    }

    public function removePhoto(int $albumId, int $photoId): Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        Album::whereId($albumId)->first()->photos()->detach($photoId);

        return response(["albumId" => $albumId, 'photoId' => $photoId, "deleted" => true], 200);
    }
}
