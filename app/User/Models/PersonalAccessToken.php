<?php

namespace App\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PersonalAccessToken extends Model
{
	use HasUuids;

	protected $fillable = [
		'name',
		'token',
		'abilities',
		'expires_at'
	];

	protected $casts = [
		'abilities' => 'json',
		'last_used_at' => 'datetime',
		'expires_at' => 'datetime'
	];

	protected $hidden = ['token'];

	public function tokenable() : MorphTo
	{
		return $this->morphTo('tokenable');
	}
}
