<ul>
    <li>
        <a href=""
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            Logout
        </a>
    </li>

    <form id="logout-form" action="" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <li><a href="{{ route('cart.index') }}">Cart
    {{-- @if (Cart::instance('default')->count() > 0)
    <span class="cart-count"><span>{{ Cart::instance('default')->count() }}</span></span>
    @endif --}}
    </a></li>
    
</ul>
