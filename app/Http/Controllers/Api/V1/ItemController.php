<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\ItemFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreItemRequest;
use App\Http\Requests\V1\UpdateItemRequest;
use App\Http\Resources\V1\ItemCollection;
use App\Http\Resources\V1\ItemResource;
use App\Models\Item;
use Illuminate\Http\Response;

final class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ItemFilter $filter): ItemCollection
    {
        $items = $filter
            ->setBuilder(Item::query())
            ->filter()
            ->include()
            ->sort()
            ->paginate();

        return new ItemCollection($items->appends($filter->request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request): ItemResource
    {
        $item = Item::create($request->all());

        if ($request->filled('categories')) {
            $item->categories()->sync($request->input('categories'));
        }

        return new ItemResource($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item): ItemResource
    {
        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item): ItemResource
    {
        $item->update($request->all());

        if ($request->filled('categories')) {
            $item->categories()->sync($request->input('categories'));
        }

        return new ItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item): Response
    {
        $item->delete();

        return response()->noContent();
    }
}
