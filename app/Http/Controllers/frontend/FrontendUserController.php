<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FrontendUserController extends Controller
{
    public function index()
    {
        return view('frontend.user.profile');
    }
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|digits:10',
            'email' => 'required|email',
            'pin' => 'required|digits:6',
            'address' => 'required|max:499',
        ]);

        $user = User::findOrFail(Auth::user()->id);

        $user->update([

            'name' =>  $request->name,
            'email' =>  $request->email,
        ]);

        $user->userDetail()->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
            'phone' =>  $request->phone,
            'pin' =>  $request->pin,
            'address' =>  $request->address,
        ]);

        return redirect()->back()->with('message','User Profile Updated');
    }

    public function changeUserPassword()
    {
        return view('frontend.user.change-password');
    }

    public function updateUserPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if(Hash::check($request->current_password, Auth::user()->password)) {

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),

            ]);

            return redirect()->back()->with('message','Password Updated Successfully');

        }
        else {
            return redirect()->back()->with('message','Current Password Does not Match with old Password');
        }

    }
}
