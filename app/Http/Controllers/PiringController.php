<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PiringController extends Controller
{
    public function createPiring_page()
    {
        return view('piringCatalogue.createPiring');
    }
}
