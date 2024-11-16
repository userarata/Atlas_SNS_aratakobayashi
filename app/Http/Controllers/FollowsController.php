<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\FollowUser;

class FollowsController extends Controller


{
    //フォローリスト
    public function followList(){
        return view('follows,followList');
    }

    //フォロワーリスト
   public function followerList(){
        return view('follows,followerList');
   }


    //フォロー機能
    public function follow($id) {
        $follower = Auth::user();
        dd($follower);
        $is_following = $follower->isfollowing($id);
        if($is_following){
            $follower->follow($id);
            return back();
        }
    }

    //フォロー解除機能
    public function unfollow(User $user) {
        $follower = Auth::user();
        $is_following = $follower->isfollowing($user->id);

        if($is_following){
          $follower->unfollow($user->id);
          return back();
        }
    }
}


// {
// public function follow(Request $request){
//     $followerID = Auth::id();
//     $userID = $request->input('user_id');

//     $follow = Follow::where('following_id',$followerID)
//     ->where('followed_id',$userID)
//     ->first();

//     if($follow){
//         // アンフォロー
//         $follow->delete();
//     }else{
//         // フォロー
//         Follow::create([
//             'following_id' => $followerId,
//             'followed_Id' => $userId,
//         ]);
//     }
//     return redirect('/search');
// }
// }