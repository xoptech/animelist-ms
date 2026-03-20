<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;

class AnimeController extends Controller
{
	public function index()
	{
		$animes = Anime::paginate(10);
		return view('animes.index', compact('animes'));
	}

	public function create()
	{
		return view('animes.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'title' => 'required',
			'genre' => 'required|in:Action,Romance,Isekai,Fantasy,Slice of Life,Horror,Sports,Mecha',
			'episodes' => 'required|integer|min:1',
			'status' => 'required|in:Watching,Completed,Plan to Watch,Dropped',
			'rating' => 'required|integer|min:1|max:10',
			'studio' => 'required',
			'cover_image' => 'nullable|url',
		]);

		Anime::create($request->all());

		return redirect()->route('animes.index')->with('success', 'Anime added successfully.');
	}

	public function show(string $id)
	{
		$anime = Anime::findOrFail($id);
		return view('animes.show', compact('anime'));
	}

	public function edit(string $id)
	{
		$anime = Anime::findOrFail($id);
		return view('animes.edit', compact('anime'));
	}

	public function update(Request $request, string $id)
	{
		$request->validate([
			'title' => 'required',
			'genre' => 'required|in:Action,Romance,Isekai,Fantasy,Slice of Life,Horror,Sports,Mecha',
			'episodes' => 'required|integer|min:1',
			'status' => 'required|in:Watching,Completed,Plan to Watch,Dropped',
			'rating' => 'required|integer|min:1|max:10',
			'studio' => 'required',
			'cover_image' => 'nullable|url',
		]);

		$anime = Anime::findOrFail($id);
		$anime->update($request->all());

		return redirect()->route('animes.index')->with('success', 'Anime updated successfully.');
	}

	public function destroy(string $id)
	{
		$anime = Anime::findOrFail($id);
		$title = $anime->title;
		$anime->delete();

		return redirect()->route('animes.index')->with('success', '"' . $title . '" removed from your list.');
	}
}