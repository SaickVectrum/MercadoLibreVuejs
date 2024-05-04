<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

	protected $rules = [
		'name' => ['required', 'string'],
	];

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return  $this->rules;
	}

	public function messages()
	{
		return [
			'name.required' => 'El nombre es requerido.',
			'name.string' => 'El nombre debe de ser valido.',
		];
	}
}
