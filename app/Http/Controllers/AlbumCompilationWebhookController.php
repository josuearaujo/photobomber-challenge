<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AlbumCompilationWebhookController
{
    public function __invoke(Request $request)
    {
        Log::warning(json_encode($request->all()));
        // TODO: handle compilation success or failure

        // $request->get('status') gives you the success ('finished') or failure ('failed') status
        // $request->get('album_id') gives you the album id
        // $request->get('error') gives you the error message in case of failure
    }
}
