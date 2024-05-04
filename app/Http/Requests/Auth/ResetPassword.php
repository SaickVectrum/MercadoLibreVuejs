<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassword extends FormRequest
{

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'token' => ['required'],
			'email' => ['required', 'email'],
			'password' => ['confirmed', 'string', 'min:8'],
		];
	}
}
