<x-app title="Inicio">
    <section class="container">
        <product-category :products="{{ json_encode($products) }}"></product-category>
    </section>
</x-app>
