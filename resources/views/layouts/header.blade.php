<header class=" ">
    <nav class="navbar navbar-expand-md bg-app">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'PEF') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    @guest
                        <li lass="nav-item">
                            <a class="nav-link" aria-expanded="false" role="button" href="{{route('find_jobs')}}"> Vagas</a>
                        </li>
                        @else
                            @if(Auth::user()->type == "Seekers")
                                <li lass="nav-item">
                                    <a class="nav-link" aria-expanded="false" role="button" href="{{route('profile')}}">Perfil</a>
                                </li>
                                <li lass="nav-item">
                                    <a class="nav-link" aria-expanded="false" role="button" href="{{route('find_jobs')}}"> Vagas</a>
                                </li>
                                <li lass="nav-item">
                                    <a class="nav-link" href="{{route('my_job_application')}}">Minhas candidaturas</a>
                                </li>
                            @elseif(Auth::user()->type == "Company")
                                <li lass="nav-item">
                                    <a class="nav-link" aria-expanded="false" role="button" href="{{route('indexed_jobs')}}"> Vagas publicadas</a>
                                </li>
                                <li lass="nav-item">
                                    <a class="nav-link" href="{{route('create_jobs')}}">Cadastre vagas</a>
                                </li>
                            @endif
                    @endguest
                    </ul>
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @auth 
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('index_inbox')}}">
                                    <i class="fa fa-comment"></i>
                                    <span class="rounded badge badge-warning text-white">{{count_unread_sms()}}</span>
                                </a>
                            </li>
                        @endauth
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Cadastra-se') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item color-app" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
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
</header>
        