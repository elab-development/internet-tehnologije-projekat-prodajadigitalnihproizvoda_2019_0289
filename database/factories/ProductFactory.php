<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
          
        return [
            'name' => fake()->name(),
            'price' => fake()->randomFloat(2, 10, 1000),
            'type' => fake()->randomElement(['slika', 'video', 'pdf']),
            'category' => fake()->word(),
            'author' => fake()->name(),
            'num_of_downloads' => fake()->numberBetween(0, 100),
            'full_product' => 'C:\Users\WindowsUser\Downloads\slika.jpeg',
            'free_version' => 'C:\Users\WindowsUser\Downloads\slika.jpeg',
            'imageUrl' =>'C:\Users\WindowsUser\Downloads\slika.jpeg',
        ];
         
        
    }
}

