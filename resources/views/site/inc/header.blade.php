<header class="header">
    <div class="container-fluid">
        <div class="row">
            @if(!empty(Auth::user()))
                <div class="col-xl-9 col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{route('home')}}">AnaSayfa</a></li>
                            <li><a href="#">Mağaza Kategorileri</a>
                                <ul class="dropdown">
                                    @foreach ($categories as $category)
                                        @include('subcategories', ['category' => $category, 'prefix' => ''])
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="{{route('order',Auth::id())}}">Siparişlerim</a></li>
                            @if (Auth::user()->role == 'sales' || Auth::user()->role == 'admin')
                                <li><a href="{{route('user.stores',Auth::id())}}">Mağazalarım</a></li>
                                <li><a href="{{route('stores.show')}}">Mağaza Ekle</a></li>
                            @endif
                            <li><a href="{{route('coupon')}}">İndirimler</a></li>
                            <li><a href="./contact.html">İletişim</a></li>
                            @if (Auth::user()->role == 'admin')
                                <li><a href="./contact.html">Admin Ol</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__right">
                        <div class="header__right__auth">
                            <a href="{{route('logout')}}">Çıkış Yap</a>
                        </div>
                        <ul class="header__right__widget">
                            <li><a href="{{route('ticket.list')}}"><i class="fa-solid fa-envelope"></i>
                                    <div class="tip">{{count(Auth::user()->ticket)}}</div>
                                </a></li>
                        </ul>&nbsp;&nbsp;&nbsp;
                        <ul class="header__right__widget">
                            <li><a href="{{route('cart',Auth::id())}}"><span class="icon_cart_alt"></span>
                                    <div class="tip">{{count(Auth::user()->cart)}}</div>
                                </a></li>
                        </ul>
                    </div>
                </div>
            @elseif(empty(Auth::user()))
                <div class="col-xl-9 col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.html">AnaSayfa</a></li>
                            <li><a href="./contact.html">İletişim</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__right">
                        <div class="header__right__auth">
                            <a href="{{route('login.show')}}">Giriş Yap</a>
                            <a href="{{route('register.show')}}">Kayıt Ol</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>