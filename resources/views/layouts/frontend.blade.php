<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="meta_keyword" content="@yield('meta_keyword')">
    <meta name="meta_description" content="@yield('meta_description')">
    <meta name="author" content="Sukesh kr">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('front/style.css')}}">
     <!-- owl caresol -->
    <link rel="stylesheet" href="{{asset('front/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/owl.theme.default.min.css')}}">
    <!-- exzoom jquery plugin  -->
    <link href="{{asset('front/exzoom/jquery.exzoom.css')}}" rel="stylesheet">


    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    @livewireStyles
</head>
<body>

    <div class="main-navbar shadow-sm sticky-top">
        <div class="top-navbar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                        <h5 class="brand-name">{{$appSetting->website_name ?? 'Website Name'}}</h5>
                    </div>
                    <div class="col-md-5 my-auto">
                        <form role="search" action="{{route('search')}}" method="GET">
                            <div class="input-group">
                                <input type="search" name="search" value="{{Request::get('search')}}" placeholder="Search your product" class="form-control" />
                                <button class="btn bg-white" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5 my-auto">
                        <ul class="nav justify-content-end">

                            @if (Auth::check())

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('order')}}">
                                    <i class="fa fa-shopping-cart"></i> My Order
                                </a>
                            </li>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('cart.list')}}">
                                    <i class="fa fa-shopping-cart"></i> Cart (<livewire:frontend.cart.cart-count/>)
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('wish.list')}}">
                                    <i class="fa fa-heart"></i> Wishlist (<livewire:frontend.wish-list-count/>)
                                </a>
                            </li>
                            @guest

                            @if (Route::has('register'))

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('login')}}">
                                    <i class="fa fa-shopping-cart"></i>
                                    {{ __('Login') }}
                                </a>
                            </li>

                            @endif

                            @if (Route::has('register'))

                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('register')}}">
                                        <i class="fa fa-shopping-cart"></i>
                                        {{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route('user.profile')}}"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa fa-list"></i> My Orders</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa fa-heart"></i> My Wishlist</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                                <li><form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            <i class="fa fa-sign-out"></i>{{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </li>
                                </ul>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand d-block d-sm-block d-md-none d-lg-none" href="#">
                    Funda Ecom
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('welcome')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('collections')}}">All Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('new.arrivals')}}">New Arrivals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('featured.products')}}">Featured Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Electronics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Fashions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Accessories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Appliances</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- Page Content -->
    <main class="py-2">
        @yield('content')
    </main>

    <!-- Footer  ------------------------ -->

    <div>
        <div class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="footer-heading">{{$appSetting->website_name ?? 'website name'}}</h4>
                        <div class="footer-underline"></div>
                        <p>
                            {{$appSetting->meta_description ?? 'website name'}}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <h4 class="footer-heading">Quick Links</h4>
                        <div class="footer-underline"></div>
                        <div class="mb-2"><a href="{{route('welcome')}}" class="text-white">Home</a></div>
                        <div class="mb-2"><a href="{{route('collections')}}" class="text-white">About Us</a></div>
                        <div class="mb-2"><a href="{{route('collections')}}" class="text-white">Contact Us</a></div>
                        <div class="mb-2"><a href="{{route('collections')}}" class="text-white">Blogs</a></div>
                        <div class="mb-2"><a href="{{route('collections')}}" class="text-white">Sitemaps</a></div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="footer-heading">Shop Now</h4>
                        <div class="footer-underline"></div>
                        <div class="mb-2"><a href="{{route('collections')}}" class="text-white">Collections</a></div>
                        <div class="mb-2"><a href="{{route('welcome')}}" class="text-white">Trending Products</a></div>
                        <div class="mb-2"><a href="{{route('new.arrivals')}}" class="text-white">New Arrivals Products</a></div>
                        <div class="mb-2"><a href="{{route('featured.products')}}" class="text-white">Featured Products</a></div>
                        <div class="mb-2"><a href="{{route('collections')}}" class="text-white">Cart</a></div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="footer-heading">Reach Us</h4>
                        <div class="footer-underline"></div>
                        <div class="mb-2">
                            <p>
                                <i class="fa fa-map-marker"></i> {{$appSetting->address ?? 'address'}}
                            </p>
                        </div>
                        <div class="mb-2">
                            <a href="" class="text-white">
                                <i class="fa fa-phone"></i> {{$appSetting->phone1 ?? 'phone1'}}
                            </a>
                        </div>
                        <div class="mb-2">
                            <a href="" class="text-white">
                                <i class="fa fa-envelope"></i> {{$appSetting->email1 ?? 'email1'}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <p class=""> &copy; 2023 - Sukesh IT - Ecommerce. All rights reserved.</p>
                    </div>
                    <div class="col-md-4">
                        <div class="social-media">
                            Get Connected:
                            <a href="{{$appSetting->facebook ?? ''}}" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="{{$appSetting->twitter ?? ''}}" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="{{$appSetting->instagram ?? ''}}" target="_blank"><i class="fa fa-instagram"></i></a>
                            <a href="{{$appSetting->youtube ?? ''}}" target="_blank"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ------------------------------------------------------------------->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script src="{{asset('front/owl.carousel.min.js')}}"></script>

<!-- jquery plugin exzoom js file  -->
<script src="{{asset('front/exzoom/jquery.exzoom.js')}}"></script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>





<script>
    window.addEventListener('message', event => {

        if(event.detail) {

            alertify.set('notifier','position', 'top-right');
            alertify.notify(event.detail.text,event.detail.type,2);

        }


    });
</script>

@yield('scripts')
@livewireScripts
@stack('scripts')
</body>
</html>
