<?php

namespace App\Http\Controllers;

class LinksPageController extends Controller
{
    public function __invoke()
    {
        return view('user.links');
    }
}
