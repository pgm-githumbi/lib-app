<?php

namespace App\Http\Controllers;

use App\Traits\Tables;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Traits\ResourceValidator;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    use Tables, HttpResponses, ResourceValidator;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $categories = Category::with('category');
        $perPage = $req->query('perPage', 10);
        $categories = $categories->paginate($perPage);
        
        return $categories;
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
    public function store(StoreCategoryRequest $req)
    {
        $req->validated();
        $category = new Category();
        $category->fill($req->validated());
        $catCat = $this->categoryCategory;
        $category->{$catCat} = $req->{$catCat} ?? null;
        $category->save();
        return $this->success($category, "Data stored successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return $this->success($category, "Category retrieved");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $req, string $id)
    {
        $cat = Category::findOrFail($id);
        $cat->update($req->validated());
        $catCat = $this->categoryCategory;
        if($req->filled($catCat)) {
            $cat->{$catCat} = $req->{$catCat};
        }
        $cat->update();
        return $this->success($cat,"Category successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return $this->success($category, "Category deleted successfully");
    }
}
