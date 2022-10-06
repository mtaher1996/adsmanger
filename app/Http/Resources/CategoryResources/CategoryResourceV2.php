<?php
namespace App\Http\Resources\CategoryResources;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\AdResources\AdResourceV2;

class CategoryResourceV2 extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
    */
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "title"=>$this->title,
            'ads'=>AdResourceV2::collection($this->ads)
        ];
    }
}
