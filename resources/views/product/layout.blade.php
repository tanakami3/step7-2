<!DOCTYPE HTML>

<html lang="ja">
<html>
<head>
    <title>商品一覧</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="/js/app.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
    <header>
        @include('product.header')
    </header>
   
    <div class="container">
        @yield('top-page')
    </div>
    
    <script src="{{ asset('/js/message.js') }}"></script>
    <script src="{{ asset('/js/buyMessage.js') }}"></script>
    
</body>
</html>
