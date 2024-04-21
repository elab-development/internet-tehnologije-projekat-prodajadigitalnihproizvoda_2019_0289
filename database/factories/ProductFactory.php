<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Services\FileService;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        // Pozivamo FileService da ubaci putanje slika
        app(FileService::class)->insertProductImages();

        $type = $this->faker->randomElement(['image', 'pdf', 'video']);
        $fileName = $this->faker->numberBetween(1, 15) . '.' . $this->faker->randomElement(['jpg', 'pdf', 'mp4']);

        // Generisanje lažnih atributa proizvoda
        $product = [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'type' => $type,
            'category' => $this->faker->word(),
            'author' => $this->faker->name(),
            'num_of_downloads' => $this->faker->numberBetween(0, 100),
            'free_version' => Storage::url("products/{$type}s/2/{$fileName}"),
            'full_product' => Storage::url("products/{$type}s/1/{$fileName}"),
            'imageUrl' => Storage::url("products/{$type}s/{$folder}/{$fileName}"),
        ];

        // Povezivanje putanja slika sa odgovarajućim atributom proizvoda
        
        $product['full_product'] = Storage::url("products/{$type}s/1/{$fileName}");
        
        $product['free_version'] = Storage::url("products/{$type}s/2/{$fileName}");
       
        return $product;
    
        
    }
}

