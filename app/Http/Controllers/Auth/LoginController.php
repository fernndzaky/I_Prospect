<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


use App\Mail\ForgotPasswordMail;


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

    public function index(){
        return view('auth/signin');
    }

    public function authenticate(Request $request)
    {


        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

 
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/dashboard');
        }

        //if authentication failed
        return back()->with('loginError', 'Ouch.. wrong credentials');
    }

    public function logout(){
        Auth::logout();
        return redirect('/signin');
    }

    public function forgetPassword(){
        return view('auth/forget-password');
    }

    public function sendNewPassword(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'email' => 'required',
        ]);
        $validator->validate();

        $user = User::where('email', $input['email'])->first();

        if (empty($user)) {
            return redirect('/forget-password')->with('emailError', "Oops! Seems like your Email does not exist. Please sign up first!");
        }

        // generate random 10 char password from below chars
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        $password = substr($random, 0, 10);

        $user->password = Hash::make($password);
        $user->save();
        
        Mail::to($user->email)->send(new ForgotPasswordMail($user, $password));
        return redirect('/signin')->with('newPasswordSent', "Alright, a new password has been sent to your email. If the email does not show up, check the Junk/Spam folder.");
    }
}
