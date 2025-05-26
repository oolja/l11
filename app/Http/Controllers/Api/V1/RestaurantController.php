<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\RestaurantsFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreRestaurantRequest;
use App\Http\Requests\V1\UpdateRestaurantRequest;
use App\Http\Resources\V1\RestaurantCollection;
use App\Http\Resources\V1\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Http\Response;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RestaurantsFilter $filter): RestaurantCollection
    {
        $restaurants = $filter
            ->setBuilder(Restaurant::query())
            ->filter()
            ->include()
            ->sort()
            ->paginate();

        return new RestaurantCollection($restaurants->appends($filter->request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request): RestaurantResource
    {
        return new RestaurantResource(Restaurant::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant): RestaurantResource
    {
        return new RestaurantResource($restaurant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant): RestaurantResource
    {
        $restaurant->update($request->all());

        return new RestaurantResource($restaurant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant): Response
    {
        $restaurant->delete();

        return response()->noContent();
    }
}
