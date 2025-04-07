<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        Restaurant::factory()
            ->has(User::factory()->count(rand(1, 3)))
            ->has(Category::factory()->count(rand(8, 10)))
            ->has(Item::factory()->count(rand(5, 8)))
            ->count(50)
            ->create();
    }
}
