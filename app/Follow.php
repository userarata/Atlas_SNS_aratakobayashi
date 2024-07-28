<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{


    public function user(){
        return $this->hasMany('App\User');
    }

    // フォローしているユーザーを取得
    public function followings(){
        return $this->belongsToMany('App\Follow','follows','following_id','followed_id');
    }

    // フォローされているユーザーを取得
    public function followers(){
        return $this->belongToMany('App\Follow','follows','followed_id','following_id');
    }

    // フォローする
    public function follow(User $data){
        $this->followings()->attach($data->id);
    }

    // フォロワーを削除する
    public function unfollow(User $data){
        $this->followings()->detach($data->id);
    }

    // フォローしているかどうか判断する
    public function inFollowing(User $data){
        return $this->Following()->where('following_id',$data->id)
        ->exists();
    }


}
