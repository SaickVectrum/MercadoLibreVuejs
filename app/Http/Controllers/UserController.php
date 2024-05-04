<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\User\UserRequest;

class UserController extends Controller
{
	public function index(Request $request)
	{
		$users = User::with('roles')->get();
		if (!$request->ajax()) return view('users.index', compact('users'));
		return response()->json(['users' => $users], 200);
		// view
	}


	public function create()
	{
		$roles = Role::all()->pluck('name');
		return view('users.create', compact('roles'));
	}


	public function store(UserRequest $request)
	{
		//User::create(['number_id' =>$request->number_id]); //es otra forma de crear un registro
		$user = new User($request->all());
		$user->save();
		$user->assignRole($request->role);
		if (!$request->ajax()) return back()->with('success', 'User created');
		return response()->json(['status' => 'User created', 'user' => $user], 201);
	}


	public function show(Request $request, User $user)
	{
		if (!$request->ajax()) return view();
		return response()->json(['user' => $user], 200);
	}


	public function edit(User $user)
	{
		$roles = Role::all()->pluck('name');
		return view('users.edit', compact('user', 'roles'));
	}


	public function update(UserRequest $request, User $user)
	{
		$user->update($request->all());
		//Este se utiliza cuando son pocos roles en los usuarios
		$user->syncRoles([$request->role]);
		if (!$request->ajax()) return back()->with('success', 'User update');
		return response()->json([], 204);
		//Este mensaje no es necesario ya que envia el cuerpo en blanco
		// return response()->json(['status' => 'User update','user' => $user], 204);
	}

	//Se utiliza este metodo cuando se pasa directamente el $id
	// public function update(UserRequest $request,$id)
	// {
	// 	$user = User::find($id);
	//  $user->update($request->all())
	// }

	public function destroy(Request $request, User $user)
	{
		$user->delete();
		if (!$request->ajax()) return back()->with('success', 'User delete');
		return response()->json([], 204);
	}
} 
