<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbumRequest;
use App\Models\Album;
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
            'photos' => $album->photos,
            'token' => $token->plainTextToken,
        ]);
    }

    public function destroy(int $id)
    {

    }
}
