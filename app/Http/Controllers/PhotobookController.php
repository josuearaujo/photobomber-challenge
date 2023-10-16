<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PhotobookController extends Controller
{
    public function index() {
        return Inertia::render('Photobook/List');
    }
}
