<x-app title="Carritos">
    <section class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    @if (Cart::count())
                        <table class="table table-striped">
                            <thead>
                                <th>FOTO</th>
                                <th>NOMBRE</th>
                                <th>CANTIDAD</th>
                                <th>PRECIO UNITARIO</th>
                                <th>VALOR</th>
                            </thead>
                            <tbody>
                                @foreach (Cart::content() as $product)
                                    <tr class="align-middle">
                                        <td><img src="{{ $product->options['image']['route'] ?? '' }}" width="50" />
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->qty }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>${{ number_format($product->qty * $product->price, 2) }}</td>
                                        <td>
                                            <form action="{{ route('removeitem') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="rowId" value="{{ $product->rowId }}">
                                                <input type="submit" name="btn" class="btn btn-danger "
                                                    value="x">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="fw-bolder">
                                    <td colspan="3"></td>
                                    <td class="text-end">Total</td>
                                    <td class="text-end">${{ number_format(Cart::subtotal(), 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('clear') }}" class="text-center"><button class="btn btn-primary"> Vaciar carrito</button></a>
                    @else
                        <a href="/" class="text-center"><button class="btn btn-primary">Agrega un producto</button></a>
                    @endif

                </div>
            </div>
        </div>
    </section>
</x-app>
