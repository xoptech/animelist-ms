<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anime extends Model
{
	use HasFactory;

	protected $fillable = [
		'title',
		'genre',
		'episodes',
		'status',
		'rating',
		'studio',
		'cover_image',
	];
}