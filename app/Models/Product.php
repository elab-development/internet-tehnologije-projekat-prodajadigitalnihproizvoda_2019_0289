<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


     public $timestamps=false;

    protected $fillable = [
        'product_id',
        'name',
        'price',
        'type',
        'category',
        'num_of_downloads',
        'full_product',
        'free_version',
        'imageUrl',
        

    ];

    protected $attributes = [
        'free_version' => null,
        


    ];


    public function order(){
        return $this->hashMany(Order::class);        
    }
}
