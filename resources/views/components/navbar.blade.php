<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a href="{{ route('home') }}" class="text-decoration-none d-flex gap-2 align-items-center me-3">
            <img src="{{ asset('assets/logo.png') }}" height="32" alt="{{ config('app.name') }} logo" loading="lazy" />
            <span class="font-weight-bold text-primary fs-5">{{ config('app.name') }}</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav nav-left">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item d-flex gap-2 flex-wrap">
                        @if (Route::has('login'))
                            <a type="button" class="btn btn-outline-primary flex-fill" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @endif

                        @if (Route::has('register'))
                            <a type="button" class="btn btn-primary flex-fill" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
