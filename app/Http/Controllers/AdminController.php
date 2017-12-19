<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Exam;
use App\Block;
use App\Problem;
use App\Category;
use App\Changelog;
use App\Http\Requests\AdminsUserRequest;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //ユーザ管理

    //ユーザ一覧ページ
    public function getUsers(){
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }

    //ユーザ情報編集ページ
    public function editUser($user_id){
        $user = User::findOrFail($user_id);
        return view('admin.edit_user', compact('user'));
    }

    //ユーザ情報更新処理
    public function updateUser($user_id, AdminsUserRequest $request){
        $user = User::findOrFail($user_id);

        $user->name = $request->name;
        $user->realname = $request->realname;
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

    public function deleteUser(Request $request){
        User::where('id', $request->user_id)
            ->delete();

        \Session::flash('flash_message', 'User successfully deleted!');
        return redirect()->back();

    }

    // 試験管理

    //試験一覧ページ
    public function getExams(){
        $exams = Exam::all();
        return view('admin.exams', ['exams' => $exams]);
    }

    //試験名編集、試験一覧ページ
    //問題が登録されていないブロックは一覧に表示されない
    public function editExam($exam_id){
        $exam = Exam::findOrFail($exam_id);
        $blocks = DB::select('select p.exam_id, b.id, b.name, count(*) as count, b.created_at, b.updated_at from blocks b join problems p on b.id = p.block_id and \''. $exam_id .'\'= p.exam_id group by b.id, p.exam_id');
        $full_blocks = Block::all();
        return view('admin.edit_exam', compact('exam', 'blocks', 'full_blocks'));
    }

    //試験名変更処理
    public function updateExam($exam_id, Request $request){
        $exam = Exam::findOrFail($exam_id);
        $exam_oldname = $exam->name;
        $exam->name = $request->name;
        $exam->save();

        $log = new Changelog();
        $log->content = Auth::user()->name.'が試験「'.$exam_oldname.'」を「'.$request->name.'」に変更しました。';
        $log->save();

        \Session::flash('flash_message', 'Exam successfully edited!');
        return redirect()->route('admin.editExam', $exam->id);
    }

    //試験作成ページ
    public function getCreateExam(){
        return view('admin.create_exam');
    }

    //試験作成処理
    public function postCreateExam(Request $request){
        $exam = new Exam();
        $exam->id = $request->id;
        $exam->name = $request->name;
        $exam->save();

        $log = new Changelog();
        $log->content = Auth::user()->name.'が試験「'.$request->name.'」を作成しました。';
        $log->save();

        \Session::flash('flash_message', 'Exam successfully created!');
        return redirect()->route('admin.exams');
    }

    //試験ブロック作成
    //実際に作成するのではなく、問題が登録されていないブロックに移動する
    //既に問題が登録されているブロックも選択できるが、該当のブロックに移動するだけなので問題ないと思われる
    //試験ブロックを新規に作成するにはcreateBlockGlobalメソッドを実行する
    public function createBlock($exam_id, Request $request){
        return redirect()->route('admin.editBlock', ['exam_id' => $exam_id, 'block_id' => $request->block_id]);
    }

    //試験ブロック名編集、試験ブロック一覧ページ
    //試験ブロックが共有されていた場合、他の試験のブロック名も変更される
    public function editBlock($exam_id, $block_id){
        $block = Block::findOrFail($block_id);
        $problems = DB::select('select p.id, p.problem_number, p.question, c.name, p.created_at, p.updated_at from problems p join categories c on c.id = p.category_id where p.exam_id = \''.$exam_id.'\' and p.block_id = \''.$block_id.'\' order by p.problem_number');
        return view('admin.edit_block',compact('exam_id','block', 'problems'));
    }

    //試験ブロック名更新処理
    public function updateBlock($exam_id, $block_id, Request $request){
        $block = Block::findOrFail($block_id);
        $block_oldname = $block->name;
        $block->name = $request->name;
        $block->save();

        $log = new Changelog();
        $log->content = Auth::user()->name.'が試験ブロック「'.$block_oldname.'」を「'.$request->name.'」に変更しました。';
        $log->save();

        \Session::flash('flash_message', 'Block successfully edited!');
        return redirect()->route('admin.editBlock', ['exam_id' => $exam_id, 'block_id' => $block_id]);
    }

    //問題作成ページ
    public function getCreateProblem($exam_id, $block_id){
        $category = Category::all();
        return view('admin.create_problem', compact('exam_id', 'block_id', 'category'));
    }

    //問題作成処理
    public function postCreateProblem($exam_id, $block_id, Request $request){

        $problem = new Problem();
        $problem->exam_id = $exam_id;
        $problem->block_id = $block_id;
        $problem->category_id = $request->category_id;
        $problem->problem_number = $request->problem_number;
        $problem->question = $request->question;
        $problem->answer1 = $request->answer1;
        $problem->answer2 = $request->answer2;
        $problem->answer3 = $request->answer3;
        $problem->answer4 = $request->answer4;
        $problem->pic_que = $request->pic_que;
        $problem->pic_ans = $request->pic_ans;
        $problem->correct = $request->correct;
        $problem->explain = $request->explain;
        $problem->save();

        $exam_name = Exam::findOrFail($exam_id)->name;
        $block_name = Block::findOrFail($block_id)->name;

        $log = new Changelog();
        $log->content = Auth::user()->name.'が試験「'.$exam_name.'」の試験ブロック「'.$block_name.'」に問題を追加しました。';
        $log->save();

        \Session::flash('flash_message', 'Problem successfully created!');
        return redirect()->route('admin.editBlock', ['exam_id' => $exam_id, 'block_id' => $block_id]);
    }

    //問題編集ページ
    public function editProblem($exam_id, $block_id, $problem_id){
        $problem = Problem::findOrFail($problem_id);
        $categories = Category::all();
        return view('admin.edit_problem', compact('exam_id', 'block_id', 'problem', 'categories'));
    }

    //問題更新処理
    public function updateProblem($exam_id, $block_id, $problem_id, Request $request){
        $problem = Problem::findOrFail($problem_id);
        $problem->category_id = $request->category_id;
        $problem->problem_number = $request->problem_number;
        $problem->question = $request->question;
        $problem->answer1 = $request->answer1;
        $problem->answer2 = $request->answer2;
        $problem->answer3 = $request->answer3;
        $problem->answer4 = $request->answer4;
        $problem->pic_que = $request->pic_que;
        $problem->pic_ans = $request->pic_ans;
        $problem->correct = $request->correct;
        $problem->explain = $request->explain;
        $problem->save();

        $exam_name = Exam::findOrFail($exam_id)->name;
        $block_name = Block::findOrFail($block_id)->name;

        $log = new Changelog();
        $log->content = Auth::user()->name.'が試験「'.$exam_name.'」の試験ブロック「'.$block_name.'」の問題を更新しました。';
        $log->save();

        \Session::flash('flash_message', 'Problem successfully edited!');
        return redirect()->route('admin.editBlock', ['exam_id' => $exam_id, 'block_id' => $block_id]);
    }

    //ブロック一覧ページ
    //試験ブロックは全試験で共有するため、新たにブロックを作成する場合はこのページで行う
    public function getBlocksGlobal(){
        $blocks = Block::all();
        return view('admin.blocks', ['blocks' => $blocks]);
    }

    //ブロック作成ページ
    public function getCreateBlockGlobal(){
        return view('admin.create_block_global');
    }

    //ブロック作成処理
    public function postCreateBlockGlobal(Request $request){
        $block = new Block();
        $block->id = $request->id;
        $block->name = $request->name;
        $block->save();

        $log = new Changelog();
        $log->content = Auth::user()->name.'が試験ブロック「'.$request->name.'」を追加しました。';
        $log->save();

        \Session::flash('flash_message', 'Block successfully created!');
        return redirect()->route('admin.getBlocksGlobal');
    }

    //ブロック編集ページ
    public function editBlockGlobal($block_id){
        $block = Block::findOrFail($block_id);
        return view('admin.edit_block_global', compact('block'));
    }

    //ブロック更新ページ
    public function updateBlockGlobal($block_id, Request $request){
        $block = Block::findOrFail($block_id);
        $block_oldname = $block->name;
        $block->id = $request->id;
        $block->name = $request->name;
        $block->save();

        $log = new Changelog();
        $log->content = Auth::user()->name.'が試験ブロック「'.$block_oldname.'」を「'.$request->name.'」変更しました。';
        $log->save();

        \Session::flash('flash_message', 'Block successfully edited!');
        return redirect()->route('admin.getBlocksGlobal');
    }

    //問題削除処理

    // 問題削除
    public function deleteProblem(Request $request){
        $exam_name = Exam::findOrFail(Problem::findOrFail($request->problem_id)->exam_id)->name;
        $block_name = Block::findOrFail(Problem::findOrFail($request->problem_id)->block_id)->name;
        Problem::where('id', $request->problem_id)
            ->delete();

        $log = new Changelog();
        $log->content = Auth::user()->name.'が試験「'.$exam_name.'」の試験ブロック「'.$block_name.'」の問題を削除しました。';
        $log->save();

        \Session::flash('flash_message', 'Problem successfully deleted!');
        return redirect()->back();
    }

    // ブロック削除
    public function deleteBlock(Request $request){
        $exam_name = Exam::findOrFail($request->exam_id)->name;
        $block_name = Block::findOrFail($request->block_id)->name;
        Problem::where('exam_id', $request->exam_id)
            ->where('block_id', $request->block_id)
            ->delete();

        $log = new Changelog();
        $log->content = Auth::user()->name.'が試験「'.$exam_name.'」の試験ブロック「'.$block_name.'」の全ての問題を削除しました。';
        $log->save();

        \Session::flash('flash_message', 'Block successfully deleted!');
        return redirect()->back();
    }

    // 試験削除
    public function deleteExam(Request $request){
        $exam_name = Exam::findOrFail($request->exam_id)->name;
        Problem::where('exam_id', $request->exam_id)
            ->delete();
        Exam::where('id', $request->exam_id)
            ->delete();

        $log = new Changelog();
        $log->content = Auth::user()->name.'が試験「'.$exam_name.'」を削除しました。';
        $log->save();

        \Session::flash('flash_message', 'Exam successfully deleted!');
        return redirect()->back();
    }

    public function deleteBlockGlobal(Request $request){
        $block_name = Block::findOrFail($request->block_id)->name;
        Problem::where('block_id', $request->block_id)
            ->delete();
        Block::where('id', $request->block_id)
            ->delete();

        $log = new Changelog();
        $log->content = Auth::user()->name.'が試験ブロック「'.$block_name.'」を削除しました。';
        $log->save();

        \Session::flash('flash_message', 'Block successfully deleted globally.');
        return redirect()->back();
    }
}