<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-category|edit-category|delete-category', ['only' => ['index','show']]);
       $this->middleware('permission:create-category', ['only' => ['create','store']]);
       $this->middleware('permission:edit-category', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-category', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('categories.index', [
            'categories' => Category::latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $input = $request->all();
    
        if ($image = $request->file('image')) {
            $destinationPath = public_path('storage');
            $coverImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $coverImage);
            $input['image'] = "$coverImage";
        }

        $input['slug'] = Str::slug($request->get('name'), '-');
      
        Category::create($input);

        return redirect()->route('categories.index')
                ->withSuccess('New category is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        return view('categories.show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $input = $request->all();
    
        if ($image = $request->file('image')) {
            $destinationPath = public_path('storage');
            $coverImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $coverImage);
            $input['image'] = "$coverImage";
        }else{
            unset($input['image']);
        }

        $input['slug'] = Str::slug($request->get('name'), '-');
            
        $category->update($input);

        return redirect()->back()
                ->withSuccess('Category is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('categories.index')
                ->withSuccess('Category is deleted successfully.');
    }
}
