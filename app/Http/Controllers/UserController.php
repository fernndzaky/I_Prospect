<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Helper\Helper;


class UserController extends Controller
{
    public function index(){
        return view('profile');
    }

    public function update_profile(Request $request){
        
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'occupancy' => ['required', 'string', 'max:255'],
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
}
