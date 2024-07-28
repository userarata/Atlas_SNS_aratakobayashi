<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
//use宣言・・・中で使うクラス（Auth）の宣言
//このファイルではIlluminate\Support\Facadesフォルダの中にあるAithクラスを使用すると宣言
//→宣言をしておけばこのファイル内においてAuthと書くだけでAuthクラスを呼びだせる
use App\User;

use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }
    

    //↓↓検索入力フォーム（投稿フォーム参考）
     public function search(Request $request){

$user = Auth::user();

//検索フォームで入力した値の取得
$keyword = $request->input('users');
// dump($request);

//データベースに問い合わせ
if (!empty($keyword)) {
    

$users = User::where('username', 'LIKE', '%'.$keyword.'%')->get();
// Userテーブルからwhereを用いて検索。→曖昧検索で持ってくる（get）
// 「.」は連結を意味する
// queryだとphpの際の表現なので上記のようにlaravel用に整理する。
    return view('users.search',['users'=>$users,'keyword'=>$keyword]);
}
//!emptyで「空でない場合」の処理
else{
    $users = User::all();
    return view('users.search',compact('users'));
}
//users.search以降を[]でひとまとめに括る


        //$list = \DB::table('users')->get();
//return view('users.search',['list'=>$list]);
//table('users')・・・テーブル情報のユーザー名=users
//view('users.search')・・・usersファイル内のsearch.blade
     
//↓↓曖昧検索（自分以外の絞られたユーザーを表示or自分以外すべてのユーザーが表示）

return view('users.search');
    }
  

//入力フォームのバリデーション
public function test(Request $request){
    $rules = [

    ];

    $this->validate($request, $rules);
}


// 
public function profiledit(Request $request){

    if($request->isMethod('post')){
        $rulus =[
            'username' => 'required|min:2|max12',
            'mail' => 'required|email|min:5|max:40|unique:users',
            'newpassword' => 'required|alpha_dash|min:8|max:20|confirmed|string',
            'newpassword_confirmation' => 'required|alpha_dash|min:8|max:20|string',
            'bio' => 'max:150',
            'iconimage' => 'image|alpha_dash|mimes:jpg,png,bmp,gif,svg',
        ];

        $message = [
            'username.required' => 'ユーザー名を入力してください',
            'username.min' => 'ユーザー名は2文字以上、12文字以下で入力してください',
            'username.max' => 'ユーザー名は2文字以上、12文字以下で入力してください',
            'mail.required' => 'メールアドレスを入力してください',
            'mail.email' => '有効なEメールアドレスを入力してください',
            'mail.min' => 'メールアドレスは5文字以上、40文字以下で入力してください',
            'mail.max' => 'メールアドレスは5文字以上、40文字以下で入力してください',
            'mail.unique:users' => 'このメールアドレスは既に失われています',
            'newpassword' => 'パスワードを入力してください',
            'newpassword.min' => 'パスワードは8文字以上、20文字以下で入力してください',
            'newpassword.max' => 'パスワードは8文字以上、20文字以下で入力してください',
            'newpassword.alpha_dash' => 'パスワードは英数字のみで入力してください',
            'newpassword.confirmed' => '確認パスワードが一致しません',
            'newpassword_confirmation.required' => '確認パスワードを入力してください',
            'newpassword.alpha_num' => 'パスワードは半角英数字で入力してください',
            'iconimage.image' => '指定されたファイルは画像ではありません',
            'iconimage.alpha_dash' => 'ファイル名は英数字のみです',
            'iconimage.mimes' => '指定されたファイルではありません',
        ];

        $validator = validator::make($request->all(),$rulus, $message);

        if($validator->fails()){
            return redirect('/profile')
            ->withErrors($validator)
            ->withInput();
        }

        $user = Auth::user();//更新の処理。ログインユーザーの取得。
        $id = Auth::id();//ログインしているユーザーidの取得。
        $validator -> validate();


        //画像登録
        $image = $request->file('iconimage')->getClientOriginalName();
        if($image != null){
            $image->store('public/images');
            \DB::table('users')
            ->where('id',$id)
            ->update([
                'images' => basename($image),
            ]);
        }
        
        $id = $request->input('id');
        $username = $request->input('name');
        $mail = $request->input('mail');
        $password = $request->input('password');
        $bio = $request->input('bio'); 
        $icon = $request->input('icon');
               
        User::where('id','$id')->update([[
            'username' => 'join',
            'mail' =>  'join@icloud',
            'password' => 'bcrypt',
            'bio' => 'Laravelの勉強をしています。',
            'images' =>  'icon',
        ]]);
dd($update);
    
return redirect('/top');
}


}
}