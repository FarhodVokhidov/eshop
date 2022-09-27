
    <nav class="navbar navbar-expand-lg flex">
        <div class="d-flex" id="navbar-content">
            <ul class="navbar-nav float-md-start">
                <li class="nav-item ">
                    <a class="nav-link text-white" href="{{url('/')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('categories')}}">All Categories</a>
                </li>
            </ul>
        </div>
        <div>
            <ul class="navbar-nav float-end">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{url('cart')}}">
                        <i class="fa fa-shopping-cart"></i> Cart <livewire:frontend.cart.cart-count />
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  text-white" href="{{url('/wishlist')}}">
                        <i class="fa fa-heart"></i> Wishlist <livewire:frontend.wishlist-count />
                    </a>
                </li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else

                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user"></i>  {{ Auth::user()->name }}
                        </a>
                        @if(Auth::user()->role_as == 1)
                            <a href="{{route('admin.home')}}" class="nav-link btn btn-behance">Dashboard</a>
                        @endif

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa fa-list"></i> My Orders</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa fa-heart"></i> My Wishlist</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                            <li>
                                <a class="dropdown-item btn-danger text-white" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>{{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

