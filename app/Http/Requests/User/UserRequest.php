<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

	public function authorize()
	{
		//Siempre debe estar en true, de lo contrario el request no va a funcionar
		return true;
	}


	protected $rules = [
		'name' => ['required', 'string'],
		'last_name' => ['required', 'string'],
		'number_id' => ['required', 'numeric', 'unique:users,number_id'],
		'email' => ['required', 'email', 'unique:users,email'],
		'password' => ['confirmed', 'string', 'min:8', 'required'],
	];

	

	public function rules()
	{
		if ($this->method() == 'PUT') {
			$this->rules['number_id'] = ['required', 'numeric', 'unique:users,number_id,' . $this->user->id];
			$this->rules['email'] = ['required', 'email', 'unique:users,email,' . $this->user->id];
			$this->rules['password'] = ['nullable', 'confirmed', 'string', 'min:8'];
		}

		if ($this->path() != 'api/register') {
			$this->rules['role'] = ['required', 'string', 'in:user,admin,librarian'];
		}

		return $this->rules;
	}

	public function messages()
	{
		return [
			'name.required' => 'El nombre es requerido',
			'name.string' => 'El nombre debe de ser valido',
		];
	}
}
