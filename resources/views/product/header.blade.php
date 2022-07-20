<script src="{{ asset('js/app.js') }}" defer></script>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarnavAltMarkup" aria-controls="#navbarnavAltMarkup" aria-expanded="false" aria-lavel="Toggle navigation"></button>
                <span class="navbar-collapse" id="navbarNavAltMarkup"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class ="nav-item nav-link active" href="{{ route('products') }}">商品一覧<span class="sr-only"></a>
                    <a class = "nav-item nav-link" href="{{ route('create') }}">商品登録</a>
                </div>
            </div>

    <div id="app">
            <div class="container">

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</nav>