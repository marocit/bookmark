<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Jobs\UpdateLastLogin;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        $this->dispatch(new UpdateLastLogin($user, Carbon::now()));
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => [
                'required',
                'string',
                Rule::exists('users')->where(function ($query) {
                    $query->where('active', true);
                })
            ],

            'password' => 'required|string',

        ], [
            $this->username() . '.exists' => 'No account found, or you need to activate your account!'
        ]);
    }
}
