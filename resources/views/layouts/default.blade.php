<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>@yield('title')</title>
</head>
<body>
<div class="body">
    <header class="bg-info mb-3 fixed-top">
        @auth
            @component('components.header', ['menu' => [
                action('IndexController@index') => '質問一覧',
                action('QuestionController@create') => '質問する',
                action('UserController@show', Auth::user()) => 'プロフィール',
            ]])
            @endcomponent
        @endauth

        @guest
            @component('components.header', ['menu' => [
                action('RegisterController@create') => 'アカウント登録',
                action('SessionController@showLoginForm') => 'ログイン',
            ]])
            @endcomponent
        @endguest
    </header>
    <main class="mb-3">
    @yield('content')
    </main>
    <footer class="footer">
        <div class="container">
            <p class="text-muted text-center border border-bottom-0 border-right-0 border-left-0 pt-3">Copyright © 2019 Ishibashi. All Rights Reserved.</p>
        </div>
    </footer>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
@stack('jquery')
</body>
</html>
