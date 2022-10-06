<?php
namespace App\Http\Resources\CategoryResources;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResourceV1 extends JsonResource
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
        ];
    }
}
