<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Category\CategoryRequest;

class CategoryController extends Controller
{
	public function index(Request $request)
	{
		$categories = Category::get();
		return view('categories.index', compact('categories'));

		// view
	}

	public function getCategory(Request $request){
		$categories = Category::get();
		if (!$request->ajax()) return view('categories.index');
		return response()->json(['categories' => $categories], 200);
	}

	public function store(CategoryRequest $request)
	{
		try {
			DB::beginTransaction();
			$category = new Category($request->all());
			$category->save();
			DB::commit();
			return response()->json([], 200);
		} catch (\Throwable $th) {
			DB::rollback();
			throw $th;
		}
	}

	public function getAll()
	{
		$categories = Category::query();
		return DataTables::of($categories)->toJson();
	}

	public function show(Category $category)
	{
		return response()->json(['category' => $category], 200);
	}


	public function update(CategoryRequest $request, Category $category)
	{
		try {
			DB::beginTransaction();
			$category->update($request->all());
			DB::commit();
			return response()->json([], 204);
		} catch (\Throwable $th) {
			DB::rollback();
			throw $th;
		}
	}



	public function destroy(Category $category)
	{
		$category->delete();
		return response()->json([], 204);
	}
}
