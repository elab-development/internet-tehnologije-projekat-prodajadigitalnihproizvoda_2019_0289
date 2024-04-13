<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void

    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Order::truncate();
        User::truncate();
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


         
        // $this->call([
        //     UsersSeeder::class,
        // ]);



        // User::factory()->count(10)->create();
        // Product::factory()->count(3)->create();
        // Order::factory()->count(4)->create();

        



        // User::factory()->create([

        //     'name' => 'Karl Nikl',
        //     'email' => 'karl@example.com',
        // ]);
    }
}
