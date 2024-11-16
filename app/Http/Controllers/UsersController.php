<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
//use宣言・・・中で使うクラス（Auth）の宣言
//このファイルではIlluminate\Support\Facadesフォルダの中にあるAithクラスを使用すると宣言
//→宣言をしておけばこのファイル内においてAuthと書くだけでAuthクラス（ログインしているユーザーの情報）を呼びだせる
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
// dd($request);
    if($request->isMethod('post')){
         $rules =[
             'username' => 'required|min:2|max:12',
             'mail' => 'required|email|min:5|max:40|unique:users',
             'password' => 'required|alpha_dash|min:8|max:20|confirmed|string',
             'password_confirmation' => 'required|alpha_dash|min:8|max:20|string',
             'bio' => 'max:150',
             'iconimage' => 'image|alpha_dash|mimes:jpg,png,bmp,gif,svg',
         ];
         //required・・・フィールドデータがNULLや空であってはならない
         //unique・・・フィールドデータがデータベーステーブル内で重複してはいけない

         $message = [
             'username.required' => 'ユーザー名を入力してください',//適用
             'username.min' => 'ユーザー名は2文字以上、12文字以下で入力してください',//適用
             'username.max' => 'ユーザー名は2文字以上、12文字以下で入力してください',//適用
             'mail.required' => 'メールアドレスを入力してください',//適用
             'mail.email' => '有効なEメールアドレスを入力してください',//適用
             'mail.min' => 'メールアドレスは5文字以上、40文字以下で入力してください',//適用
             'mail.max' => 'メールアドレスは5文字以上、40文字以下で入力してください',//適用
             'mail.unique' => 'このメールアドレスは既に失われています',//適用
             'password.required' => 'パスワードを入力してください',//適用
             'password.min' => 'パスワードは8文字以上、20文字以下で入力してください',//適用
             'password.max' => 'パスワードは8文字以上、20文字以下で入力してください',//適用
             'password_confirmation.required' => '確認パスワードが一致しません',//適用
             'iconimage.image' => '指定されたファイルは画像ではありません',//適用
             'iconimage.alpha_dash' => 'ファイル名は英数字のみです',//適用
             'iconimage.mimes' => '指定されたファイルではありません',//適用
         ];

         $validator = validator::make($request->all(),$rules, $message);
 //バリデーションが失敗した場合のエラーの処理
         if($validator->fails()){
             return redirect('/profile')
             ->withErrors($validator)
             ->withInput();
         }

        $user = Auth::user();//更新の処理。ログインユーザーの取得。
        $id = Auth::id();//ログインしているユーザーidの取得。
         $validator -> validate();


        //画像登録
        // $image = $request->file('iconimage')->getClientOriginalName();
        // if($image != null){
        //     $image->store('public/images');
        //     \DB::table('users')
        //     ->where('id',$id)
        //     ->update([
        //         'images' => basename($image),
        //     ])
        // }
        // dd($request);
        $id = Auth::id();
        // dd($id);
        $username = $request->input('name');
        $mail = $request->input('mail');
        $password = $request->input('password');
        $bio = $request->input('bio'); 
        // $icon = $request->input('icon');
        $filename = $request->images->getClientOriginalName();
        $images = $request->images->storeAs('user-images',$filename,'public');
        // dd($images);
               
        User::where('id',$id)->update([
            'username' => $username,
            'mail' =>  $mail,
            'password' => bcrypt($password),
            //ログイン時にパスワードは空欄にする
            'bio' => $bio,
            'images' =>  $images,
        ]);
// dd($update);
    
return redirect('/top');
}

//フォロー機能
// public function follow(User $user)
// {
//   $user = Auth::user();  
//   $follower = auth()->user();
//   $is_following = $follower->isFollowing($user->id);
//   if(!$is_following) {
//   $follower->follow($user->id);
//   return back();
//   }
// }

//フォロー解除
// public function unfollow(User $user)
// {
//   $user = Auth::user();
//   $follower = auth()->user();
//   $is_following = $follower->isFollowing($user->id);
//   if($is_following) {
//   $follower->unfollow($user->id);
//   return back();
//   }
// }

}
}