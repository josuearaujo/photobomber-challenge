<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AlbumController extends Controller
{
    public function index() {
        return Inertia::render('Photobook/List');
    }
}
