<x-app>
    <section>
        <div class="d-flex justify-content-center my-4">
            <h1>Carrito de compras</h1>
        </div>
        <cart-shop :products="{{ $products }}" :carts="{{ $carts }}"
          ></cart-shop>
    </section>
</x-app>
