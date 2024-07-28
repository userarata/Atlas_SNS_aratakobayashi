<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowsController extends Controller

{
public function follow(Request $request){
    $followerID = Auth::id();
    $userID = $request->input('user_id');

    $follow = Follow::where('following_id',$followerID)
    ->where('followed_id',$userID)
    ->first();

    if($follow){
        // アンフォロー
        $follow->delete();
    }else{
        // フォロー
        Follow::create([
            'following_id' => $followerId,
            'followed_Id' => $userId,
        ]);
    }
    return redirect('/search');
}
}