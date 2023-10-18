<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbumRequest;
use App\Models\Album;
use App\Models\Photo;
use App\Services\AlbumCompiler;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class AlbumController extends Controller
{
    private AlbumCompiler $albumCompiler;

    public function __construct(AlbumCompiler $albumCompiler)
    {
        $this->albumCompiler = $albumCompiler;
    }

    public function index(): Response
    {
        $user = auth()->user();
        $token = $user->createToken('all');

        $albums = Album::whereUserId($user->id)->with('photos')->orderByDesc('created_at')->get();

        return Inertia::render('Album/List', [
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

        return redirect()->route('album.show', ['album' => $album]);
    }

    public function show(Album $album): Response
    {
        $user = auth()->user();
        $token = $user->createToken('all');

        return Inertia::render('Album/Show', [
            'album' => $album,
            'albumPhotos' => $album->photos,
            'userPhotos' => $user->photos,
            'token' => $token->plainTextToken,
        ]);
    }

    public function destroy(int $id)
    {

    }

    public function addPhoto(Album $album, Photo $photo): \Illuminate\Contracts\Foundation\Application|ResponseFactory|Application|\Illuminate\Http\Response
    {
        $album->photos()->attach($photo);

        return response(["albumId" => $album->id, 'photoId' => $photo->id, "attached" => true], 200);
    }

    public function removePhoto(Album $album, Photo $photo): Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        $album->photos()->detach($photo);

        return response(["albumId" => $album->id, 'photoId' => $photo->id, "deleted" => true], 200);
    }

    public function compile(Album $album): void
    {
        Log::warning('Trying to dispatch compilation' . json_encode($album));

        $this->albumCompiler->compile($album);
    }
}
