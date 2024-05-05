<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
	public function index()
	{
		// Obtener el ID del usuario autenticado
		$userId = Auth::id();

		// Obtener los productos en el carrito del usuario
		$carts = Cart::where('user_id', $userId)->get();

		// Recuperar los detalles del producto para cada ítem del carrito
		$products = $carts->map(function ($cart) {
			return Product::with('file')->find($cart->product_id);
		});

		return view('cart.index', compact('products'));
	}
	public function add($productId)
	{
		// Obtener el producto
		$product = Product::findOrFail($productId);

		// Verificar si el producto ya está en el carrito del usuario
		$cartItem = Cart::where('user_id', Auth::id())->where('product_id', $productId)->first();

		if ($cartItem) {
			// Si el producto ya está en el carrito, aumentar la cantidad en 1
			$cartItem->quantity += 1;
			$cartItem->save();
		} else {
			// Si el producto no está en el carrito, crear un nuevo item de carrito
			Cart::create([
				'user_id' => Auth::id(),
				'product_id' => $productId,
				'quantity' => 1,
				//  'price' => $product->price, // Puedes almacenar el precio en el carrito o calcularlo dinámicamente
			]);
		}

		return redirect()->route('cart.index')->with('success', 'Producto añadido al carrito exitosamente');
	}
}
