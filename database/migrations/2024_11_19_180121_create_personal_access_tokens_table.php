<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up() : void
	{
		Schema::create('personal_access_tokens', function (Blueprint $table) {
			$table->uuid('id')->primary();
			$table->uuidMorphs('tokenable');
			$table->string('name');
			$table->text('token')->unique();
			$table->timestamp('last_used_at')->nullable();
			$table->timestamp('expires_at')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down() : void
	{
		Schema::dropIfExists('personal_access_tokens');
	}
};
