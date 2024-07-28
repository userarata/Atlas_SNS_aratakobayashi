<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use Auth;
use Validator;
use Illuminate\Http\Request;


class PostsController extends Controller
{
    //トップページの表示
    public function index(){
      $list = \DB::table('posts')->get();
      return view('posts.index',['list'=>$list]);
    }
//新規投稿の処理
    public function create(Request $request){
 $post = $request->input('newPost');
 $user_id = Auth::user()->id;
 //誰がその投稿をしたか
 //newPostの受け取り
        \DB::table('posts')->insert([
            'post' => $post,
            'user_id' => $user_id
        ]);
//テーブル内に記述した内容を入れる（insert）
        return redirect('top');
    }
//つぶやき削除
public function delete($id)
{
    \DB::table('posts')
    ->where('id', $id)
    ->delete();

    return redirect('top');
}

public function update(Request $request)
{

    $id = $request->input('id');
    // dd($id);
    $up_post = $request->input('upPost');
    \DB::table('posts')
    ->where('id', $id)
    ->update(
        ['post' => $up_post]
    );

    return redirect('top');
}
//検索箇所の下にdd($);入力で受け取りできたか確認可能
//Controllerとblade繋ぐ場合は名前を合わせる



}
