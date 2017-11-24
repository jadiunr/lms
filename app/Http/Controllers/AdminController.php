<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Exam;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    //ユーザ管理

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

    // 試験管理

    public function getExams(){
        $exams = Exam::all();
        return view('admin.exams', ['exams' => $exams]);
    }

    public function editExam($id){
        $exam = Exam::findOrFail($id);
        $old_exam = Exam::findOrFail($id);
        return view('admin.edit_exam', compact('exam', 'old_exam'));
    }

    public function updateExam($id, Request $request){
        $exam = Exam::findOrFail($id);
        $exam->id = $request->id;
        $exam->name = $request->name;
        $exam->save();

        \Session::flash('flash_message', 'Exam successfully edited!');
        return redirect()->route('admin.editExam', $exam->id);
    }
}
