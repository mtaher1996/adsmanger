<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\AdResources\AdResourceV1;

use App\Models\Ad;
use App\Models\Ad_Tag;
use App\Models\Tag;
use Validator;

class AdController extends Controller
{

    public function index(Request $request)
    {
        $ads = new Ad;
        if($request->filter && isset($request->filter['users']) ){
            $userArr = $request->filter['users'];
            if($userArr){
                $ads = $ads->where(function ($q) use ($userArr){
                    $q->whereIn('user_id',$userArr);
                });
            }
        }
        if($request->filter && isset($request->filter['categories']) ){
            $categoriesArr = $request->filter['categories'];
            if(count($categoriesArr)){
                $ads = $ads->where(function($q) use($categoriesArr){
                    $q->whereIn('category_id', $categoriesArr);
                });
            }
        }
        if($request->filter && isset($request->filter['tags']) ){
            $tagsArr = $request->filter['tags'];
            if(count($tagsArr)){
                $ads = $ads->where(function ($q) use ($tagsArr){
                    $q-> whereHas('tags',function($q) use ($tagsArr){
                        return $q->whereIn('tags.id',$tagsArr);
                    });
                });
            }
        }

        $ads = $ads->get();
        $data['ads'] = AdResourceV1::collection($ads);
        return['status'=>1,'data'=>$data];
    }

    public function get($id)
    {
        $ad = Ad::find($id);
        $data['ad'] = new AdResourceV1($ad);
        return['status'=>1,'data'=>$data];
    }

    public function store( Request $request)
    {
        $input =$request->all();

        $validator = Validator::make($input, [
            'title' =>'required',
            'description' =>'required',
            'start_at' =>'required|date',
            'category_id' =>'required|exists:categories,id',
            'user_id' =>'required|exists:users,id',
        ]);
        if($validator->fails())
        {
            $data['errors'] = $validator->errors()->all();
            return ['status'=>0,'data'=>$data];
        }

        $ad = Ad::create($input);
        $data['ad'] = $ad;
        return['status'=>1,'data'=>$data];
    }
    public function update(Request $request , $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'category_id' =>'exists:categories,id',
            'user_id' =>'exists:users,id',
        ]);
        if($validator->fails())
        {
            $data['errors'] = $validator->errors()->all();
            return ['status'=>0,'data'=>$data];
        }
        $ad = Ad::find($id);
        if($ad){
            $ad->update($input);
            $data['ad'] = $ad;
            return['status'=>1,'data'=>$data];
        }
        return ['status'=>-1 , 'message'=>trans('messages.not_found')];
    }
    public function delete($id)
    {
        $ad = Ad::find($id);
        if($ad){
            $ad->delete();
            return['status'=>1,'mesage'=>trans("messages.delete_done")];
        }
        return ['status'=>-1 , 'message'=>trans('messages.not_found')];
    }

    public function updateTag(Request $request){
        $ad = Ad::find($request->ad_id);
        $tag = Tag::find($request->tag_id);
        if($ad && $tag){
            $addTag = Ad_Tag::where(['ad_id'=>$ad->id , 'tag_id'=>$tag->id])->first();
            if($addTag){
                $addTag->delete();
            }else{
                Ad_Tag::create($request->all());
            }
            return ['status'=>1];
        }
        return ['status'=>-1 , 'message'=>trans('messages.not_found')];
    }
}
