<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{

	public function authorize()
	{
		return true;
	}


	public function rules()
	{
		return [
			'email' => ['required', 'email'],
			'password' => ['required', 'string'],
		];
	}
}
