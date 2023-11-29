<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Album;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AlbumController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-album|edit-album|delete-album', ['only' => ['index','show']]);
       $this->middleware('permission:create-album', ['only' => ['create','store']]);
       $this->middleware('permission:edit-album', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-album', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('albums.index', [
            'albums' => Album::latest()->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('albums.create', [
            'categories' => Category::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlbumRequest $request)
    {
        $input = $request->all();
    	$tags = explode(",", $request->tags);
    	$album = Album::create($input);
    	$album->attachTags($tags);

        return redirect()->route('albums.index')
        ->withSuccess('New Album is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        return view('albums.show', [
            'album' => $album,
            'categories' => Category::get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        return view('albums.edit', [
            'album' => $album,
            'categories' => Category::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlbumRequest $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        //
    }
}
