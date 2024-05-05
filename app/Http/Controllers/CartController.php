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
		//se trae el id del usuario
		$userId = Auth::id();

		//Se trae el carrito de acuerdo al id del usuario
		$carts = Cart::where('user_id', $userId)->get();

		//Se agrega items al producto
		$products = $carts->map(function ($cart) {
			$product = Product::with('file')->find($cart->product_id);
			//Se le pasa la cantidad
			$product->quantity = $cart->quantity;
			//Se pasa el valor total de los productos de acuerdo con la cantidad
			$product->totalPrice = $cart->quantity * $product->price;
			return $product;
		});

		return view('cart.index', compact('products', 'carts'));
	}
	public function add($productId)
	{
		// Busca el producto de acuerdo al id
		$product = Product::findOrFail($productId);

		// Verificacion de si ya esta el producto en el carrito
		$cartItem = Cart::where('user_id', Auth::id())->where('product_id', $productId)->first();

		if ($cartItem) {
			// Si el producto ya está en el carrito, se aumenta la cantidad en 1
			$cartItem->quantity += 1;
			$cartItem->save();
		} else {
			// Si el producto no está en el carrito, se crea un nuevo carrito
			Cart::create([
				'user_id' => Auth::id(),
				'product_id' => $productId,
				'quantity' => 1,
			]);
		}

		return redirect()->route('cart.index')->with('success', 'Producto añadido al carrito exitosamente');
	}

	public function delete($productId)
	{
		//Se busca el producto de acuerdo con el id del usuario.
		$cartItem = Cart::where('product_id', $productId)->first();

		if ($cartItem) {
			$cartItem->delete();
			return response()->json([], 204);
		} else {
			return response()->json(['error' => 'El producto no se encontró en el carrito'], 404);
		}
	}

	public function clear()
	{
		//Se trae el id del usuario
		$userId = Auth::id();
		//Se eliminan todos los productos que esten asociados al usuario.
		Cart::where('user_id', $userId)->delete();

		return response()->json([], 204);
	}
}
