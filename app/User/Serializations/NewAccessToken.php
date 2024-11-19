<?php

namespace App\User\Serializations;

use App\User\Models\PersonalAccessToken;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

class NewAccessToken implements Arrayable, Jsonable
{
	public function __construct(public PersonalAccessToken $accessToken, public string $plainTextToken)
	{
	}

	public function toArray() : array
	{
		return [
			'accessToken' => $this->accessToken,
			'plainTextToken' => $this->plainTextToken
		];
	}

	public function toJson($options = 0) : string
	{
		return json_encode($this->toArray());
	}
}
