<?php

namespace App\User\Traits;

use Illuminate\Support\Facades\Auth;
use App\User\Models\PersonalAccessToken;
use App\User\Serializations\NewAccessToken;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasApiTokens
{
	protected PersonalAccessToken $accessToken;

	/**
	 * Получает все токены, связанные с пользователем.
	 *
	 * @return MorphMany.
	 */
	public function tokens() : MorphMany
	{
		return $this->morphMany(PersonalAccessToken::class, 'tokenable');
	}

	/**
	 * Создает новый персональный токен доступа для пользователя.
	 *
	 * @param string $name
	 * @param array $abilities
	 *
	 * @return NewAccessToken
	 */
	public function createToken(string $name, array $abilities = ['*'])
	{
		$accessToken = $this->tokens()->create([
			'name' => $name,
			'token' => $plainTextToken = $this->generateTokenString(),
			'expires_at' => now()->addMinutes(config('jwt.ttl')),
		]);

		return new NewAccessToken($accessToken, $plainTextToken);
	}

	/**
	 * Генерирует JWT токен.
	 *
	 * @return string
	 */
	public function generateTokenString() : string
	{
		return (string) Auth::login($this);
	}

	/**
	 * Возвращает текущий токен доступа.
	 *
	 * @return PersonalAccessToken|null
	 */
	public function currentAccessToken() : PersonalAccessToken
	{
		return $this->accessToken;
	}

	/**
	 * Устанавливает текущий токен доступа.
	 *
	 * @param PersonalAccessToken $accessToken.
	 * @return static
	 */
	public function withAccessToken(PersonalAccessToken $accessToken) : static
	{
		$this->accessToken = $accessToken;
		return $this;
	}
}
