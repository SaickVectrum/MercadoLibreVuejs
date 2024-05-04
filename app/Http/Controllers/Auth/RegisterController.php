<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\UserRequest;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\User\UserRegisterRequest;

class RegisterController extends Controller
{


	use RegistersUsers;

	protected $redirectTo = RouteServiceProvider::HOME;

	public function __construct()
	{
		$this->middleware('guest');
	}

	public function register(UserRegisterRequest $request)
	{
		$user = new User($request->all());
		$user->save();
		$user->assignRole('user');
		Auth::login($user);
		return redirect($this->redirectPath());
	}
}
