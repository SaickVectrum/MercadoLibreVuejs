<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'category_id',
		'title',
		'price',
		'stock',
		'description',
	];

	protected $appends = ['format_description'];

	public function formatDescription(): Attribute
	{
		return attribute::make(
			// Mutador
			get: function ($value, $attributes) {
				return Str::limit($attributes['description'], 80, '...');
			},
			//Accesor
			// set: fn ($value)=>Str::upper($value)
		);
	}

	/**
	 *Book::with('category','author')->get();
	 */
	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}

	public function file()
	{
		return $this->morphOne(File::class, 'fileable');
	}
}
