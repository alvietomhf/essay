<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

    protected function redirectTo()
    {
        $role = Auth::user()->roles->pluck('name')[0];
    
        switch ($role) {
            case 'admin':
                    return '/admin/dashboard';
                break;
            default:
                    return '/dashboard'; 
                break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::where($this->username(), $request->{$this->username()})->first();

        if (!$user) {
            throw ValidationException::withMessages([
                $this->username() => ['Username yang anda masukkan tidak benar.'],
            ]);
        }

        if ($user && !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Password yang anda masukkan tidak benar.'],
            ]);
        }
    }
}
