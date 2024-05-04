<x-app title="Inicio">
    <section class="container">
        <product-index :products="{{ json_encode($products) }}"></product-index>
    </section>
</x-app>
