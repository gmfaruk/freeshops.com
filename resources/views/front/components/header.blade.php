<header id="topnav" class="defaultscroll sticky">
    <div class="container-fluid">
        <!-- Logo container-->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-1 col-sm-2 col-2 order-lg-1 order-1">
                <div class="menu-extras">
                    <div class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </div>
                </div>
            </div>
            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-3 order-lg-2 order-2 px-1">
                <a class="logo" href="{{ route('home') }}">
                    <img src="{{ asset(setting('logo')) }}" height="60" alt="">
                </a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-12 order-lg-3 order-4 m-auto">
                <form action="{{ route('all') }}" class="navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Entery Keyword..." name="q" value="{{ $req->q ?? '' }}" autocomplete="off">
                        <button class="btn btn-sm btn-primary"><i data-feather="search" class="icons"></i></button>
                    </div>
                    <input type="hidden" name="category" value="{{ $req->category ?? '' }}">
                    <input type="hidden" name="sort" value="{{ $req->sort ?? 'latest' }}">
                </form>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-12 order-lg-4 order-5 m-auto">
                <a href="javascript:;" class="location" data-bs-toggle="modal" data-bs-target="#nearbyModal"><i data-feather="map-pin" class="icons"></i> <span class="header-location-name">Nearby</span></a>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-10 col-sm-8 col-7 order-lg-5 order-3 m-auto">
                <div class="top-nav text-end">
                    <ul>
                        <li class="d-sm-inline-block d-none"><a href="{{ route('about.us') }}">About</a></li>
                        <li class="d-sm-inline-block d-none"><a href="{{ route('term.services') }}">Terms of Service</a></li>
                        <li class="d-sm-inline-block d-none"><a href="{{ route('contact.us') }}">Contact Us</a></li>
                          @auth
                            @if (auth()->user()->role == "1")
                                <li class="d-sm-inline-block d-none"><a href="{{ route('user.dashboard') }}">My Account</a></li>
                            @else
                                <li class="d-sm-inline-block d-none"><a href="{{ route('admin.dashboard') }}">My Account</a></li>
                            @endif
                          @endauth
                          <li><a href="{{route('gallery')}}" class="btn btn-icon btn-soft-primary cart-dropdown" ><i class="uil uil-video align-middle icons h5"></i></a></li>

                            <li>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-icon btn-soft-primary cart-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="uil uil-shopping-cart align-middle icons"></i></button>
                                    <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow rounded border-0 mt-3 p-4" style="width: 300px; margin: 0px;">
                                        <div id="status" class="loader" style="display: none">
                                            <div class="spinner">
                                                <div class="double-bounce1"></div>
                                                <div class="double-bounce2"></div>
                                            </div>
                                        </div>
                                        <div class="cart-block">
                                            <div class="cart">
                                                @if(!empty(CartP::count()))
                                                    @foreach (CartP::content() as $item)
                                                        @php
                                                            $headerlisting = App\Models\Listing::get_single($item->id);
                                                        @endphp

                                                        <div class="d-flex align-items-center mb-4">
                                                            <img src="{{ asset($headerlisting->featured_image) }}" class="shadow rounded" style="max-height: 64px;" alt="">
                                                            <div class="flex-1 text-start ms-3">
                                                                <h6 class="text-dark mb-0">{{ $headerlisting->title }}</h6>
                                                                <small class="text-muted mb-0">{{ $headerlisting->category->name }}</small>
                                                            </div>
                                                            {{-- <span class="d-inline-block text-danger cursor-pointer removeCart" data-id="{{ $item->id }}"><i data-feather="trash" class="icons"></i></span> --}}
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <h4 class="text-center">Cart is Empty</h4>
                                                @endif
                                            </div>

                                            <div class="mt-3 text-center pt-4 border-top">
                                                <a href="{{ route('cart') }}" class="btn btn-primary d-block">View Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        @if(empty(Auth::check()))
                            <li><a href="javascript:;" data-bs-toggle="modal" data-bs-target="#accountModal">Login</a></li>
                        @endif
                        
                        <li><a href="{{ route('post.ad') }}" class="btn btn-primary">Post Ad</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Logo container-->


    </div><!--end container-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                        @foreach (getNavCat() as $item)
                            <li><a data-slug="{{ $item->slug }}" href="{{ route('all') }}?category={{ $item->slug }}" class="sub-menu-item cat-item">{{ $item->name }}</a></li>
                        @endforeach
                        @if (count(getOtherNavCat()) > 0)

                        @endif
                        <li class="has-submenu parent-parent-menu-item">
                            <a href="javascript:void(0)">Others</a><span class="menu-arrow"></span>
                            <ul class="submenu">
                                @foreach (getOtherNavCat() as $item)
                                    <li><a data-slug="{{ $item->slug }}" href="{{ route('all') }}?category={{ $item->slug }}" class="sub-menu-item cat-item">{{ $item->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul><!--end navigation menu-->
                </div><!--end navigation-->
            </div>
        </div>
    </div>
</header><!--end header-->
