<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

<script src="{{ asset('js/script.js')}}"></script>

</head>
<body>
    <header>
<div class="container">
    <div class="header_left">
        <h1>〇〇〇</h1>
    </div>
    <div class="header_right">
        <ul class="menu_list">
            <li class="nav_item"><a href="#" class="js-dropdown">admin さん</a>
        <div class="panel js-dropdown-menu">
            <ul class="panel-inner">
                <li class="panel_item"><a href="#">HOME</a></li>
                <li class="panel_item"><a href="#">プロフィール編集a</a></li>
                <li class="panel_item"><a href="#">ログアウト</a></li>
            </ul>
        </div>
        </li>
        </ul>
    </div>
</div>

        <!-- アコーディオンテスト -->
        <div class="menu">
  <laravel for="menu_bar01">アコーディオン</laravel>
  <input type="button" id="menu_bar01" />
    <ul id="links01">
        <li><a href="/top">HOME</a></li>
        <li><a href="/profile">プロフィール編集</a></li>
        <li><a href="/logout">ログアウト</a></li>
</ul>
</div>
<!--ここが表示されてる-->


<div class="btn-group">
<button type="button" class="btn btn-default dropdown-toggle">

</div>


    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p>〇〇さんの</p>
                <div>
                <p>フォロー数</p>
                <p>〇〇名</p>
                </div>
                <p class="btn"><a href="/followList">フォローリスト</a></p>
                <div>
                <p>フォロワー数</p>
                <p>〇〇名</p>
                </div>
                <p class="btn"><a href="/followerList">フォロワーリスト</a></p>
            </div>
            <p class="btn"><a href="search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="JavaScriptファイルのURL"></script>

</body>
</html>
