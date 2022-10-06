<?php
namespace App\Http\Resources\AdResources;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TagResources\TagResourceV1;
use App\Http\Resources\UserResources\UserResourceV1;

class AdResourceV2 extends JsonResource
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
            "describtion"=>$this->description,
            'start_at'=>$this->start_at,
            'is_free'=>$this->isFree,
            'user'=>new UserResourceV1($this->user),
            "tags"=>TagResourceV1::collection($this->tags)
        ];
    }
}
