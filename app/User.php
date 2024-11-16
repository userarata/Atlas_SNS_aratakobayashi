<?php
namespace App;



use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password', 'bio','following_user_id', 'followed_user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



// フォロー、フォロワー
public function follow($user_id){
    return $this->follows()->attach($user_id);
}

public function unfollow($user_id){
    return $this->follows()->detack($user_id);
}

public function isfollowing($user_id){
    return (bool) $this->follows()->where('followed_id',$user_id)->exists();
}

public function isFollowed($user_id){
    return (bool) $this->followers()->where('following_id',$user_id)->exists();
}

// フォローボタン設置、解除
public function follows()
    {
        return $this->belongsToMany('App\User', 'follow_users', 'followed_user_id', 'following_user_id');
    }
// public function follows(){
//     return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
// }

public function follower()
    {
        return $this->belongsToMany('App\User', 'follow_users', 'following_user_id', 'followed_user_id');
    }
// public function follower(){
//     return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
// }

}

?>

