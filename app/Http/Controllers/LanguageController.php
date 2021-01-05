<?php

namespace App\Http\Controllers;

class LanguageController extends Controller
{
    function __invoke(\Request $request, string $lang)
    {
        if (!in_array($lang, config('app.supported_locales')))
            return back();

        \Session::put('locale', $lang);
        \Auth::user()->update(["language" => $lang]);
        return redirect()->back();
    }
}
