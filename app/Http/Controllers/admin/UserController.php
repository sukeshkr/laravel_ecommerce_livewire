<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $datas = User::paginate(10);
        return view('admin.user.index',compact('datas'));
    }
    public function userCreate()
    {
        return view('admin.user.create');
    }
    public function userPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|integer',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as' => $request->role,
        ]);
        return redirect()->back()->with('success','Created Successfully');
    }
    public function userEdit(int $userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.user.edit',compact('user'));

    }
    public function userUpdate(Request $request,int $userId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|min:8',
            'role' => 'required|integer',
        ]);

        $user = User::findOrFail($userId);

        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role_as' => $request->role,
        ]);

        return redirect()->back()->with('success','Updated Successfully');
    }
    public function userDelete(int $userId)
    {
        $user= User::findOrFail($userId);
        $user->delete();

        return redirect()->back()->with('success','Deleted Successfully');
    }
}
