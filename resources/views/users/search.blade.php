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

<table class="container-list">
  <table class='table table-hover'>
    @foreach ($users as $user)
    <!--コントローラーから受け取った$users(左)を反復処理させる-->
    <!--自分以外を表示させる-->
<tr>
  <td><img src="{{ $user->images }}" alt="ユーザーアイコン"></td>
  <td>{{ $user->username }}</td>
</tr>


<!-- フォローする/フォロー解除ボタン -->
<!-- フォローする -->
<form action="{{ route('follows,follow') }}" method="POST">
  <input type="hidden" name="user_id" value="">
  <button type="submit" class="btn btn-primary">
    フォローする
</button>
</form>

<!-- フォロー解除 -->
<form action="{{ route('follows,unfollow') }}"method="POST">
  <input type="hidden" name="user_id" value="">
  <button type="submit" class="btn btn-primary">
    フォロー解除
</button>
</form>

@endforeach

</table>
</div>

@endsection
