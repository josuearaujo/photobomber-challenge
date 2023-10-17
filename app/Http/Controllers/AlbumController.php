<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbumRequest;
use App\Models\Album;
use Illuminate\Http\RedirectResponse;
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
            'title' => $validated->title,
            'description' => $validated->description,
            'layout' => $validated->layout
        ]);

        return redirect()->route('photobook.show', ['id' => $album->id]);
    }

    public function show(Album $album): Response
    {
        $user = auth()->user();
        $token = $user->createToken('all');

        return Inertia::render('Album/Show', [
            'album' => $album,
            'photos' => $album->photos,
            'token' => $token,
        ]);
    }

    public function destroy(int $id)
    {

    }
}
