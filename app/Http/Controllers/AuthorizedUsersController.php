<?php

namespace App\Http\Controllers;

use App\Models\AuthorizedUser;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorizedUsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        return view('admin.authorized_users');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function store(Request $request)
    {
        $email = $request->validate([
            'email' => ['required', 'email', 'unique:authorized_users,email']
        ])['email'];

        AuthorizedUser::create(['email' => $email]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AuthorizedUser $authorizedUser
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function destroy(AuthorizedUser $authorizedUser)
    {
        $authorizedUser->delete();
        return back();
    }
}
