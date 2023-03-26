<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // Call the external API to authenticate the user
        $response = Http::post("https://symfony-skeleton.q-tests.com/api/v2/token", [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ]);

        if ($response->failed()) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        // Set the user data in session
        $user = $response->json();
        if (!empty($user)) {
            $user['user']['token'] = $user['token_key'];
            Session::put('user', $user['user']);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
