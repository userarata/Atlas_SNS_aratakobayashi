@extends('layouts.login')
@section('content')

<!-- バリデーションのエラーメッセージ -->
@if($errors->any())
 <div class="edit_error">
  <ul>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
</ul>
</div>
@endif
<!-- $errors->all()・・・全てのエラーを取得 -->
<!-- $errors->first()・・・最初のエラーだけを取得 -->

<p>プロフィール</p>


<form class=""action="{{url('/profile')}}" method="POST" enctype="multipart/form-data">
  <?php $user = Auth::user(); ?>
  
  <figure><img width="32" src="{{ asset('/strage/' . $user->images ) }}"></figure>
  <div class="form-group mb-3">
    user namespace
    <input type="text" value="{{ $user->username }}" class="input" name="name">
</div><br>

<div class="form-group mb-3">
  mail adress
  <input type="text" value="{{ $user->mail }}" class="input" name="mail">
</div><br>

<div class="form-group mb-3">
  password
  <input type="password" class="input" name="password">
</div><br>

<div class="form-group mb-3">
  password comfirm
  <input type="password" value="" class="input" name="password">
  <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
</div><br>

<div class="form-group mb-3">
  bio
  <textarea value="" name="bio">{{ $user->bio }}</textarea>
</div><br>

<div class="form-group mb-3">
  icon image
  <input type="file" name="images" class="custom-file-input" id="fileImage">
</div>

<div class="btn-profileupdate">
  <button type="submit" class="btn btn-primary btn-profileupdate">更新</button>
</div>
{{csrf_field()}}


</form>


@endsection
