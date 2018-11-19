<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Dish extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "image" => $this->image,
            "name" => $this->name,
            "description" => $this->description,
        ];
    }

    public function with($request){
        return [
            "version" => "1.0.0",
            "author_url" => "josebric.com",
        ];
    }
}
