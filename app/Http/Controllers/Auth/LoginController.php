<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Session;

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

    public function actionlogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $request->session()->put('login_date', $request->login_date);
        $request->session()->put('login_area', $request->input('area'));

        if (Auth::Attempt($data)) {
            $area = Auth::user()->area;
            return redirect('stocks');
        }else{
            return redirect('/')->with('error', 'Email atau Password Salah');
        }
    }

    public function actionloginGudang(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        if (Auth::Attempt($data)) {
            $area = Auth::user()->area;
            return redirect('showProduct-gudang');
        }else{
            return redirect('/')->with('error', 'Email atau Password Salah');
        }
    }


    public function actionlogout(Request $request)
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
