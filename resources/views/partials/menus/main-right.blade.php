<ul>
    @guest
    <div >
        @auth
            <a href="{{ url('/user') }}" class="text-sm text-gray-700 underline">Shop</a>
        @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>&nbsp;

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
            @endif
        @endif
    </div>
    @else
    <li>
        <a href="{{ route('logout') }}"
                               class="no-underline hover:underline text-gray-300 text-sm p-3"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
    </li>

    <form id="logout-form" action="" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <li><a href="{{ route('cart.index') }}">Cart
        @if (Cart::instance('default')->count() > 0)
        <span class="cart-count"><span>{{ Cart::instance('default')->count() }}</span></span>
        @endif
        </a></li>
    @endguest
    
</ul>
