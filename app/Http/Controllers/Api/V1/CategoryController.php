<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\CategoryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCategoryRequest;
use App\Http\Requests\V1\UpdateCategoryRequest;
use App\Http\Resources\V1\CategoryCollection;
use App\Http\Resources\V1\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryFilter $filter): CategoryCollection
    {
        $categories = $filter
            ->setBuilder(Category::query())
            ->filter()
            ->include()
            ->sort()
            ->paginate();

        return new CategoryCollection($categories->appends($filter->request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): CategoryResource
    {
        return new CategoryResource(Category::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): CategoryResource
    {
        $category->update($request->all());

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): Response
    {
        $category->delete();

        return response()->noContent();
    }
}
