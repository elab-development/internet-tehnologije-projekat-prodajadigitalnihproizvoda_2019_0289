<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            'product_id' => $this->resource->id,
            'name' => $this->resource->name,
            'price'=>$this->resource->price,
            'type' => $this->resource->type,
            'category' => $this->resource->category,
            'author' => $this->resource->author,
            'num_of_downloads' => $this->resource->num_of_downloads, 
            'full_product' => $this->resource->full_product,
            'free_version' => $this->resource->free_version,
            'imageUrl' => $this->resource->imageUrl,

        ];
    }


}
