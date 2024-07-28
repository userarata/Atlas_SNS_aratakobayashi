
@extends('layouts.login')

@section('content')

    @foreach ($list as $list)
    <tr>
      <td>{{ $list->id }}</td>
      <td>{{ $list->post }}</td>
      <td>{{ $list->created_at }}</td>
    </tr>

<!--つぶやき編集-->
<div class="content">
  <!---投稿の編集ボタン-->
  <a class="js-modal-open" href="" post="{{ $list->post }}" post_id="{{ $list->id }}">編集</a>

</div>

<!--つぶやき削除-->
      <td><a class="btn btn-danger" href="/post/{{$list->id}}/delete">削除</a></td>
  <td><a class="btn btn-danger" href="/post/{{$list->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a></td>

    @endforeach

<!--モーダルの中身-->
<div class="modal js-modal">
  <div class="modal_bg js-modal-close"></div>
  <div class="modal_content">
    <form action="update" method="post">
      <textarea name="upPost" class="modal_post"></textarea>
      <!--Controllerの名前と合わせる-->
      <input type="hidden" name="id" class="modal_id" value="">
      <!--Controllerの名前と合わせる-->
      <input type="submit" value="更新">
      @csrf
    </form>
    <a class="js-modal-close" href="">閉じる</a>
  </div>
</div>



<div class="container">
  <h2 class="page-header">新しく投稿する</h2>
  {!! Form::open(['url' => 'post/create']) !!}
  <!--URLの指定-->

  <div class="form-group">
    {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}
  </div>
  <!--newPostがPostsControllerに送られる-->
  <button type="submit" class="btn btn-success pull-right">追加</button>
  {!! Form::close() !!}
</div>
<!--ここまでつぶやき登録-->



@endsection
