@extends('layouts.login')

@section('content')


<!--検索ボックス-->
<div id = "search">
  <form action="/search" method="get">
    <input type="keyword" name="users" placeholder="ユーザー名" >
<!--検索ボタン-->
<button type="submit" class="btn btn-success pull-right"><img src="/images/search.png"></button> 
  </form>
  </div>

 <!--検索ワードを表示--> 
@if (!empty($keyword))
<p>検索ワード:{{ $keyword }}</p>
@endif

<!--保存されてるリスト一覧の表示-->
<div class="container-list">


    @foreach ($users as $user)
    <!--コントローラーから受け取った$users(左)を反復処理させる-->
    <!--自分以外を表示させる-->
  <p><img src="{{ $user->images }}" alt="ユーザーアイコン"></p>
  <p>{{ $user->username }}</p>
  <!-- $user->username・・・特定のユーザー名を指定しない記述 -->

<!--フォローしているユーザーの場合-->


<!-- フォローする/フォロー解除ボタン -->
<!-- フォローする -->
<form action="{{ route('follows.follow',['id' => $user->id]) }}" method="POST">
  <!-- $user->id・・・特定のidを指定しない記述 -->
   @csrf
<input type="hidden" name="user_id" value="">
  <button type="submit" class="btn btn-primary">
    フォローする
</button>
</form>

<!-- フォロー解除 -->
<form action="{{ route('follows,unfollow',['id' => $user->id]) }}"method="POST">
  <input type="hidden" name="user_id" value="">
  <button type="submit" class="btn btn-primary">
    フォロー解除
</button>
</form>

@endforeach

</div>

@endsection
