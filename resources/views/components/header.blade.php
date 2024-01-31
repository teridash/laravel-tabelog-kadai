<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<nav class="navbar navbar-expand-md navbar-light" style="background-color: #D6E5DF;">
            <div class="container header">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item mr-5">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                        </li>
                        <li class="nav-item mr-5">
                          <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                        </li>
                        @else
                        <li class="nav-item mr-5">
                        <a class="nav-link" href="{{ route('mypage') }}">
                        <i class="fas fa-user mr-1"></i>
                        <label>マイページ</label>
                        </a>
                        </li>
                        <li class="nav-item mr-5">
                        <a class="nav-link" href="{{ route('campany') }}">
                        <i class="fas fa-user mr-1"></i>
                        <label>会社情報</label>
                        </a>
                        </li>
                        
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>