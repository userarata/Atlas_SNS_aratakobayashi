<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
//トップページの表示
Route::get('/top','PostsController@index');

//プロフィール画面の表示
Route::get('/profile','UsersController@profile');

// プロフィールを更新させる
Route::post('/profile','UsersController@profiledit');


Route::get('/search','UsersController@search');
//UsersController内のsearchとつなげる（ユーザー検索の動き）

Route::get('/username','UsersController@username');
Route::post('/username','UsersController@username');
//検索フォーム用

// FollowsControllerとメソッドを合わせる
Route::get('/followList','FollowsController@followList');
Route::get('/followerList','FollowsController@followerList');
//logout
Route::get('/logout','Auth\LoginController@logout');
//PostsController内の処理
Route::post('post/create','PostsController@create');
//post/createの際にPostsController内のindexに繋ぐ


//The GET method is not supported for this route. Supported methods: POST.(ルーティングのpostもしくはgetの確認)

Route::get('post/{id}/delete', 'PostsController@delete');

Route::post('update', 'PostsController@update');


// フォローする
Route::post('/user/{id}/follow', 'FollowsController@follow')->name('follows,follow');
// Route::post('/follow','FollowsController@follow')->name('follows,follow');

// フォロー解除
Route::post('/user/{id}/unfollow', 'FollowsController@unfollow')->name('follows,unfollow');
// Route::post('/unfollow','FollowsController@unfollow')->name('follows,unfollow');



