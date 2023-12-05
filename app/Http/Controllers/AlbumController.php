<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Album;
use App\Models\Image;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
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
        $album->delete();
        return redirect()->route('albums.index')
                ->withSuccess('Album is deleted successfully.');
    }

    /**
     * Add image to the album
     */
    public function addImage(Album $album, $id) {

        return view('albums.addImage', [
            'id' => $id,
            'album' => $album
        ]);

    }

    public function storeImage(StoreImageRequest $request, Image $image): RedirectResponse
    {
        $input = $request->all();
        $input['album_id'] = $request->id;

        // if ($image = $request->file('image')) {
        //     $destinationPath = public_path('storage/albums');
        //     $image_name = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $image_name);
        //     $input['image'] = $image_name;
        // }

    	Image::create($input);

        return redirect()->back() 
        ->withSuccess('New Image is added successfully.');
    }
}
