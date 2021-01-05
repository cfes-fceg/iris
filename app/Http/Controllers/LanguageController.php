<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\RedirectResponse;
use Request;
use Session;

class LanguageController extends Controller
{
    function __invoke(Request $request, string $lang): RedirectResponse
    {
        if (!in_array($lang, config('app.supported_locales')))
            return back();

        Session::put('locale', $lang);
        if(Auth::user())
            Auth::user()->update(["language" => $lang]);
        return redirect()->back();
    }
}
