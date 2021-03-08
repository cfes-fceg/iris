<?php

namespace App\Http\Controllers;

use App\Models\AuthorizedUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    public static string $SESSION_KEY = 'authorized_email';

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function check(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:authorized_users,email']
        ]);

        Session::push(self::$SESSION_KEY, $request->email);

        return \view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param Request $request
     * @return RedirectResponse
     *
     * @throws \Exception
     */
    public function register(Request $request)
    {
        if(!Session::has(self::$SESSION_KEY))
            abort(400, "An authorized email must be validated before you can register.");

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => Session::get(self::$SESSION_KEY)[0],
            'is_active' => true,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        AuthorizedUser::where('email', $user->email)->first()->delete();
        Session::remove(self::$SESSION_KEY);

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
