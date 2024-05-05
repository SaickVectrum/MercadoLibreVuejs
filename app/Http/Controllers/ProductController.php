<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\ProductUpdateRequest;


class ProductController extends Controller
{
	use UploadFile;

	public function home(Request $request)
	{
		$buscarpor = $request->get('buscarpor');
		$products = Product::with('category', 'file')->whereHas('category')->where('title', 'like', '%' . $buscarpor . '%')->where('stock', '>', 0)->get();
		return view('index', compact('products'));
	}

	public function index()
	{

		$products = Product::with('category', 'file')->whereHas('category')->get();
		return view('products.index', compact('products'));
	}



	public function productoSeleccionado($idproduct)
	{
		$product =  Product::with('file')->findOrFail($idproduct);
		return view('products.only', compact('product'));
	}

	public function productosPorCategoria($nameCategory)
	{
		$category = Category::where('name', $nameCategory)->firstOrFail();
		$products = Product::with('file')->where('category_id', $category->id)->get();
		return view('products.category', compact('category', 'products'));
	}

	public function store(ProductRequest $request)
	{
		try {
			DB::beginTransaction();
			$product = new Product($request->all());
			$product->save();
			$this->uploadFile($product, $request);
			DB::commit();
			return response()->json([], 200);
		} catch (\Throwable $th) {
			DB::rollback();
			throw $th;
		}
	}

	public function show(Product $product)
	{
		return response()->json(['product' => $product], 200);
	}

	public function update(ProductUpdateRequest $request, Product $product)
	{
		try {
			DB::beginTransaction();
			$product->update($request->all());
			$this->uploadFile($product, $request);
			DB::commit();
			return response()->json([], 204);
		} catch (\Throwable $th) {
			DB::rollback();
			throw $th;
		}
	}

	public function destroy(Product $product)
	{
		$product->delete();
		$this->deleteFile($product);
		return response()->json([], 204);
	}
}
