<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} {{ app()->version() }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">

    {{-- top bar  --}}
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="{{ route('bookmark') }}">{{ config('app.name', 'BookmarkAPP') }} {{ app()->version() }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @if (Auth::guest())
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                @else
                <li class="nav-item px-2">
                    <a href="{{ route('bookmark') }}" class="nav-link">Bookmark</a>
                </li>

                    <li class="nav-item px-5 dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <img src="{{ Auth::user()->avatar() }}" class="figure-img img-fluid rounded">
                           {{ Auth::user()->name }}
                       </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                            <small class="dropdown-item">
                               Last Login: {{ Auth::user()->last_login->diffForHumans() }}
                            </small>
                            <a href="{{ route('logout') }}" class="dropdown-item"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>

    </nav>


    <section id="header-section" class="pt-5 mb-0 py-2 bg-light ">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <div class="py-5">
              <h4 class="display-4">Bookmarks</h4>
              <p class="lead">Speichere deine Bookmarks!</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="d-flex justify-content-center">
        <div class="btn-group" role="group">
            <button class="btn btn-secondary mobile-button" data-toggle="modal" data-target="#addBookmarkModal">
                <i class="fa fa-plus"></i> Add Bookmark
            </button>
             <button class="btn btn-secondary  mobile-button" data-toggle="modal" data-target="#addCategoryModal">
               <i class="fa fa-plus"></i> Add Category
            </button>
        </div>
    </div>

    <section id="main-section">
        <div class="container">
            @include('layouts._alerts')
        </div>

        <div class="container">
            <div class="row">
                @yield('content')
            </div>
            @yield('pagination')
        </div>
    </section>



</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
