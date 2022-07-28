<li class="nav-item dropdown">
    <a id="navbarDropdown2" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        Animals in CART: {{$count}}
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">
        @forelse($cart as $animal)
        <a class="dropdown-item">
            {{$animal->name}} {{$animal->count}}
        </a>
        @empty
            Your cart, my darling, is empty yet. Go buy something!
        @endforelse
    </div>
</li>
