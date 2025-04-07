<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        Category::factory()->count(5)->create();

        Product::factory()->count(10)->hasCategory(5)->create();

        Order::factory()->count(10)->hasUser(10)->create();

        OrderProduct::factory()->count(45)->hasOrder(10)->hasProduct(10)->create();
    }
}
