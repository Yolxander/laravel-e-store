<ul>
    <h1>ready to shop</h2>

    <form id="logout-form" action="" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    {{-- <li><a href="{{ route('cart.index') }}">Cart
    @if (Cart::instance('default')->count() > 0)
    <span class="cart-count"><span>{{ Cart::instance('default')->count() }}</span></span>
    @endif
    </a></li> --}}
    
</ul>
