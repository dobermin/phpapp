<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{DIRECTORY_SEPARATOR}}public{{DIRECTORY_SEPARATOR}}css{{DIRECTORY_SEPARATOR}}style.css"
          rel="stylesheet">
    <script type="text/javascript" src="public{{DIRECTORY_SEPARATOR}}js{{DIRECTORY_SEPARATOR}}jquery.min.js"></script>
    <script type="text/javascript" src="public{{DIRECTORY_SEPARATOR}}js{{DIRECTORY_SEPARATOR}}js.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <title>Веб-приложение</title>
</head>
<body>
<div class="container">
    <header>
        <nav>
            <ul class="navbar-nav">
                @if(isset($_COOKIE['user']['name']) && !empty($name = $_COOKIE['user']['name']))
                    @include('user')
                @else
                    @include('guest')
                @endif
            </ul>
        </nav>
    </header>
    <main>
        @yield('main')
    </main>
    <footer></footer>
</div>
</body>
</html>