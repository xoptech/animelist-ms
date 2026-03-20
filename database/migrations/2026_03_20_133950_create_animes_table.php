<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('animes', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->enum('genre', ['Action', 'Romance', 'Isekai', 'Fantasy', 'Slice of Life', 'Horror', 'Sports', 'Mecha']);
			$table->integer('episodes');
			$table->enum('status', ['Watching', 'Completed', 'Plan to Watch', 'Dropped']);
			$table->integer('rating');
			$table->string('studio');
			$table->string('cover_image')->nullable();
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('animes');
	}
};