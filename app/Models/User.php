<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Lend;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use HasRoles, HasApiTokens, HasFactory, Notifiable, SoftDeletes;


	protected $fillable = [
		'number_id',
		'name',
		'last_name',
		'email',
		'password',
	];

	protected $appends = ['full_name'];

	//Este se utiliza para ocultar esta informacion al momento de consultar
	protected $hidden = [
		'password',
		'remember_token',
	];


	protected $casts = [
	    'created_at' => 'datetime:Y-m-d',
		'updated_at' => 'datetime:Y-m-d',
		// 'is_enable' => 'boolean' //0-1:true,false
	];

	/**
	 * User::query()->getFullNameAttribute()->get()
	 */
	/*
	Accessor (get)
	*/
	public function getFullNameAttribute()
	{
		return "{$this->name} {$this->last_name}";
	}

	/**
	 * (new User($request->all()))->save();
	 */

	/**
	 * Mutadores
	 */
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value);
	}

	public function setRememberTokenAttribute()
	{
		$this->attributes['remember_token'] = Str::random(30);
	}

}
