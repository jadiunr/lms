<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    public function getUsers(){
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }

    public function editUser($id){
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function updateUser($id, Request $request){
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->file('file')){
            \File::delete('storage/img/' . $user->icon);
            $filename = $request->file->store('public/img');
            $image = Image::make('storage/img/' .basename($filename))->resize(200,200)->save();
            $user->icon = $image->basename;
        }
        $user->admin = $request->admin;
        $user->save();

        \Session::flash('flash_message', 'User successfully edited!');
        return redirect()->route('admin.users');
    }
}
