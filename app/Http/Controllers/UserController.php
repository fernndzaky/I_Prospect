<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Helper\Helper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


use App\Mail\PasswordChangedMail;

class UserController extends Controller
{
    public function index(){
        return view('profile');
    }

    public function update_profile(Request $request){
        
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'occupancy' => ['required', 'string', 'max:255'],
            'avatar' => ['max:5000'],
        ]);

        $user = User::findOrFail(Auth::user()->id);

        $user->name         = $validatedData['name'];
        $user->occupancy    = $validatedData['occupancy'];

        if ($request->has('avatar')) {
            if($user->avatar)
                unlink($user->avatar);
            $user->avatar = Helper::storeImage($request->file('avatar'), 'storage/images/users/');
        }

        $user->save();

        if ($user->wasChanged()) 
            $message = 'Your profile has been updated.';
        else
            $message = 'No changes was made to your profile';
        

        return redirect()->route('user-profile')->with('message', $message);
    }

    public function changePassword(Request $request){
        $validation_rules = [
            'old_password' => 'required',
            'password' => ['required', 'confirmed','string', 'min:5']
        ];

        $validator = Validator::make($request->all(), $validation_rules);

        //if there is an error in the validation
        if ($validator->fails()) {
            return redirect(route('user-profile') . '#change-password')
                ->withErrors($validator);
        }

        $validated = $request->only(['old_password', 'password']);
        $user = auth()->user();

        // Check if old password matches.
        if (!Hash::check($validated['old_password'], $user->password)) {
            return redirect(route('user-profile') . '#change-password')
                ->withErrors([
                    'old_password' => 'Old password does not matched..'
                ]);
        }

        // Check if new password is the same with old password.
        if (Hash::check($validated['password'], $user->password)) {
            return redirect(route('user-profile') . '#change-password')
                ->withErrors([
                    'password' => 'New pasword cannot be the same..'
                ]);
        }

        //if all validation has passed, change the password
        $user->password =  Hash::make($validated['password']);
        $user->save();

        Mail::to(auth()->user()->email)->send(new PasswordChangedMail());


        return redirect()->route('user-profile')->with('message', 'Your password has been updated.');

    }
}
