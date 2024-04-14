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


    // const TYPE_VIDEO = 'video';
    // const TYPE_PDF = 'pdf';
    // const TYPE_IMAGE = 'image';
    
    // public function addImage($image){

    //      $path=$image->store('image/product');
    //     $this->update(['path_to_the_image'=>$path]);
   
    // }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        
    ];

    public function order(){
        return $this->hashMany(Order::class);        
    }
}
