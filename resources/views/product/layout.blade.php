<!DOCTYPE HTML>

<html lang="ja">
<html>
<head>
    <title>商品一覧</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="/js/app.js" defer></script>
</head>
<body>
    <header>
      @include('product.header')
    </header>
   
    <div class="container">
        @yield('top-page')
    </div>

    

    
    <script src="{{ asset('/js/message.js') }}"></script>

    
</body>
</html>
