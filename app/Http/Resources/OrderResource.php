<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            'user_id' => $this->resource->user_id,
            'product_id' => $this->resource->product_id,
            'order_date' => $this->resource->order_date

        ];
    }


}
