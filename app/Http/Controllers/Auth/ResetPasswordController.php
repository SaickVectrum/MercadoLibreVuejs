<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\Auth\ResetPassword;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{

	use ResetsPasswords;

	public function reset(ResetPassword $request)
	{
		$response = $this->broker()->reset(
			$this->credentials($request),
			function ($user, $password) {
				$this->resetPassword($user, $password);
			}
		);

		return $response == Password::PASSWORD_RESET
			? $this->sendResetResponse($request, $response)
			: $this->sendResetFailedResponse($request, $response);
	}

	protected function resetPassword(User $user, $password)
	{
		$user->update(['password' => $password, 'remember_token' => Str::random(20)]);
		Auth::login($user);
	}

	protected $redirectTo = RouteServiceProvider::HOME;
}
