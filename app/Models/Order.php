<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     public $timestamps=false;


    protected $fillable = [
        'user_id',
        'product_id',
        'order_date',
    ];


    public function user(){
        return $this->hashMany(User::class);        
    }
    public function product(){
        return $this->belongsTo(Product::class);        
    }
}
