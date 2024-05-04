<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchProduct
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
	 * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
	 */
	public function handle(Request $request, Closure $next)
	{

		$buscarpor = $request->get('buscarpor');
		$searchproducts = Product::with('category', 'file')
			->whereHas('category')
			->where('title', 'like', '%' . $buscarpor . '%')
			->where('stock', '>', 0)
			->get();

		// Puedes adjuntar los productos y la cadena de búsqueda a la solicitud
		$request->merge(['searchProducts' => $searchproducts, 'buscarpor' => $buscarpor]);
		view()->share('buscarpor', $buscarpor);

		return $next($request);
	}
}
