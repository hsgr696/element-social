<?php

namespace App\User\Models;

use App\User\Traits\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
	use HasUuids, HasApiTokens;
	protected $fillable = [
		'name',
		'username',
		'email',
		'password'
	];

	protected $casts = [
		'password' => 'hashed'
	];

	protected $hidden = ['password'];

	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	public function getJWTCustomClaims()
	{
		return [];
	}
}
