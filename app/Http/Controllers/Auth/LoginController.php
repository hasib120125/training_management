<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    protected $maxAttempts = 5;
    protected $decayMinutes = 1;
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
    /**
      * Get the login username to be used by the controller.
      *
      * @return string
      */
    public function username()
    {
        return 'username';
    }
    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => [
              'required',
              'string',
              function ($attribute, $value, $fail) use ($request) {
                  $user = User::where('username', $request->username)->first();
                  if (!empty($user) && !$user->is_active) {
                      return $fail("Your account is not active");
                  }
                  if (!empty($user) && $user->is_locked) {
                      return $fail('Too many login attempts, Please contact respective authority.');
                  }
              }
            ]
        ]);
    }
    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        throw ValidationException::withMessages([
            $this->username() => ['Too many login attempts, Please contact respective authority'],
        ])->status(423);
    }
    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $count = User::where('username', '=', $request->username)
        ->where('is_active', true)
        ->count();
        if (!$count) {
            return false;
        }
        return $this->guard()->attempt(
                        $this->credentials($request),
            $request->has('remember')
        );
    }
}
