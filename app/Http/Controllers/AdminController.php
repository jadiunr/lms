<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Exam;
use App\Block;
use App\Problem;
use App\Category;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //ユーザ管理

    public function getUsers(){
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }

    public function editUser($user_id){
        $user = User::findOrFail($user_id);
        return view('admin.edit_user', compact('user'));
    }

    public function updateUser($user_id, Request $request){
        $user = User::findOrFail($user_id);

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

    public function editExam($exam_id){
        $exam = Exam::findOrFail($exam_id);
        $blocks = DB::select('select p.exam_id, b.id, b.name, count(*) as count, b.created_at, b.updated_at from blocks b join problems p on b.id = p.block_id and \''. $exam_id .'\'= p.exam_id group by b.id, p.exam_id');
        return view('admin.edit_exam', compact('exam', 'blocks'));
    }

    public function updateExam($exam_id, Request $request){
        $exam = Exam::findOrFail($exam_id);
        $exam->name = $request->name;
        $exam->save();

        \Session::flash('flash_message', 'Exam successfully edited!');
        return redirect()->route('admin.editExam', $exam->id);
    }

    public function getCreateExam(){
        return view('admin.create_exam');
    }

    public function postCreateExam(Request $request){
        $exam = new Exam();
        $exam->id = $request->id;
        $exam->name = $request->name;
        $exam->save();

        \Session::flash('flash_message', 'Exam successfully created!');
        return redirect()->route('admin.editExam', $exam->id);
    }

    public function editBlock($exam_id, $block_id){
        $block = Block::findOrFail($block_id);
        $problems = DB::select('select p.id, p.problem_number, p.question, c.name, p.created_at, p.updated_at from problems p join categories c on c.id = p.category_id where p.exam_id = \''.$exam_id.'\' and p.block_id = \''.$block_id.'\' order by p.problem_number');
        return view('admin.edit_block',compact('exam_id','block', 'problems'));
    }

    public function editProblem($problem_id){
        $problem = Problem::findOrFail($problem_id);
        $categories = Category::all();
        return view('admin.edit_problem', compact('problem', 'categories'));
    }

    public function updateProblem($problem_id, Request $request){
        $problem = Problem::findOrFail($problem_id);
        $problem->problem_number = $request->problem_number;
        $problem->category_id = $request->category_id;
        $problem->question = $request->question;
        $problem->save();
        \Session::flash('flash_message', 'Problem successfully edited!');
        return redirect()->route('admin.editProblem', $problem->id);
    }
}