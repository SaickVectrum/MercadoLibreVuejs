<nav class="navbar navbar-expand-md navbar-light bg-warning shadow-sm">

    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">

            <img
                src="https://http2.mlstatic.com/frontend-assets/ml-web-navigation/ui-navigation/6.6.41/mercadolibre/logo_large_25years_v2.png" /></a>

        {{-- Haburguesa --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon">hola</span>
        </button>
        <form class="d-flex  " action="{{ url('/') }}">
            <input name="buscarpor" class="form-control me-2 w-100" type="search" placeholder="Buscar producto"
                aria-label="Search" value="{{ $buscarpor }}">
            <button class="btn btn-primary" type="submit">Buscar </button>
        </form>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">


            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                Inicio de sesión
                            </a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registro</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->full_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                            @role('admin')
                                {{-- User --}}
                                <a class="dropdown-item" href="{{ route('users.index') }}">
                                    Usuarios
                                </a>
                            @endrole

                            {{-- Ambos roles pueden ver esta seccion --}}
                            @role('admin')
                                {{-- Book --}}
                                <a class="dropdown-item" href="{{ route('products.index') }}">
                                    Productos
                                </a>
                            @endrole
                            @can('categories.index')
                                {{-- Category --}}
                                <a class="dropdown-item" href="{{ route('categories.index') }}">
                                    Categorias
                                </a>
                            @endcan

                            {{-- Logout --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('checkout') }}"><i class="fa-solid fa-cart-shopping"></i><span
                                class="badge bg-primary mx-1">{{ \Cart::count() }}</span></a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
