<li class="nav-item dropdown">
    <a id="navbarDropdown2" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        Animals in CART: {{$count}}
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">
        @forelse($cart as $animal)
        <span class="dropdown-item">
            <div class="cart-item">
            <span>
            {{$animal->name}} {{$animal->getThisAnimalsColor_plese->title}} {{$animal->count}}
            </span>
            <b class="delete--cart--item" data-item-id="{{$animal->id}}">X</b>
            </div>
        </span>
        @empty
            Your cart, my darling, is empty yet. Go buy something!
        @endforelse
    </div>
</li>
