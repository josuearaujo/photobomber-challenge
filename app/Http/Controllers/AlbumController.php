<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbumRequest;
use App\Models\Album;
use App\Models\Photo;
use App\Services\AlbumCompiler;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
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

        $albums = Album::whereUserId($user->id)->with('photos')->orderByDesc('created_at')->get();

        return Inertia::render('Album/List', [
            'albums' => $albums,
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

    public function show(Album $album): RedirectResponse|Response
    {
        $user = auth()->user();

        if(in_array($album->status, ['pending', 'finished'])){
            return redirect()->route('album.index')->with(['message' => 'Album is not a draw!', 'type' => 'error']);
        }

        return Inertia::render('Album/Show', [
            'album' => $album,
            'albumPhotos' => $album->photos,
            'userPhotos' => $user->photos,
        ]);
    }

    public function destroy(Album $album): Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        $album->delete();

        return response(["deleted" => true], 200);
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

    public function compile(Album $album): JsonResponse
    {
        $album->status = 'pending';
        $album->error_message = null;
        $album->save();

        $this->albumCompiler->compile($album);

        return response()->json(['message' => 'Compilation started']);
    }

    public function checkCompilation(Album $album): JsonResponse
    {
        if($album->status === 'pending') {
            return response()->json(['status' => $album->status]);
        } else {
            return response()->json(['status' => $album->status, 'message' => $album->error_message]);
        }
    }
}
