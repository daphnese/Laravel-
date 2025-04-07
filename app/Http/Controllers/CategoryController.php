<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CategoryCollection(Category::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        return new CategoryResource(Category::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show($category_id)
    {
        if ($category = Category::where('category_id', $category_id)->first()) {
            return new CategoryResource($category);
        }else
        {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $category_id)
    {
        if ($category = Category::where('category_id', $category_id)->first()) {
            $category->update($request->all());
            return new CategoryResource($category);
        }else{
            return response()->json(['message' => 'Category not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category_id)
    {
        if ($category = Category::where('category_id', $category_id)->first()) {
            $category->delete();
            return response()->json(['message' => 'Category deleted'], 200);
        }else{
            return response()->json(['message' => 'Category not found'], 404);
        }
    }
}
