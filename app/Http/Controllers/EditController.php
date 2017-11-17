<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class EditController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('edit')->with(compact('user'));
    }

    public function upload(Request $request)
    {
        $messages = [
            'required' => '画像が必須です。',
            'file' => '画像がアップロードされていないか不正なデータです。',
            'image' => 'jpg、png、bmp、gif、svg以外はアップロードできません。'
        ];

        $validator = validator::make($request->all(),[
            'file' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                //画像(jpg、png、bmp、gif、svg)
                'image',
            ]
        ],$messages);

        if ($validator->fails()) {
            return redirect('/edit')
                ->withErrors($validator)
                ->withInput();
        }else {
            $user = Auth::user();
            \File::delete('storage/img/' . $user->icon);
            $filename = $request->file->store('public/img');

            $image = Image::make('storage/img/' .basename($filename))->resize(200,200)->save();

            $user->icon = $image->basename;
            $user->save();

            return redirect('/edit')->with('success', 'アイコンを保存しました。');
        }
    }

    public function password(Request $request)
    {
        $messages = [
            'required' => '入力が必須です。',
            'min' => '最低6文字です。',
            'max' => '最高12文字です。'
        ];

        $validator = validator::make($request->all(),[
            'oldpassword' => 'required|min:6|max:12',
            'newpassword1' => 'required|min:6|max:12',
            'newpassword2' => 'required|min:6|max:12'
        ],$messages);

        $user = Auth::user();
        $db_password = $user->password;//現在のパスワード
        $password = $request->oldpassword;//現在のパスワードを入力されたもの
        $new_password1 = $request->newpassword1;//新しく設定するパスワード
        $new_password2 = $request->newpassword2;//新しく設定するパスワード(確認)

        if ($validator->fails()) {
            return redirect('/edit')
                ->withErrors($validator)
                ->withInput();
        }else {
            if ($new_password1 === $new_password2) {
                if (Hash::check($password, $db_password))//平文のパスワードをハッシュ化してDBのパスワードを比較
                {
                    $hash_password = Hash::make($new_password1);//新規パスワードをハッシュ化
                    $user->password = $hash_password;//ハッシュ化したのをDBにいれる
                    $user->save();//終わり
                    return redirect('edit')->with(compact('user'))->with('success', 'パスワードを変更しました。');
                } else {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors(['password' => 'パスワードが間違っています。']);
                }
            } else {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['password' => '新しいパスワードが一致していません。']);
            }
        }
    }

    public function name(Request $request)
    {

    }
}
