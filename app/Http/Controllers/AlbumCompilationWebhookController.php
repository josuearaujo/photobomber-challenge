<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AlbumCompilationWebhookController
{
    public function __invoke(Request $request)
    {
        $album = Album::whereId($request->get('album_id'))->first();

        $album->status = $request->get('status');

        if($request->get('status') === 'failed') {
            $album->error_message = $request->get('error');
        }

        $album->save();
    }
}
