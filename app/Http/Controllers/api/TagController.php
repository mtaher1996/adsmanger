<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use App\Http\Resources\AdResources\AdResourceV1;
// use App\Http\Resources\tagResourses\tagResource;

use App\Models\Tag;
use Validator;


class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::get();
        $data['tags'] = $tags;
        return['status'=>1,'data'=>$data];
    }

    public function get($id)
    {
        $tag = Tag::find($id);
        $data['tag'] = $tag;
        return['status'=>1,'data'=>$data];
    }

    public function store( Request $request)
    {
        $input =$request->all();

        $validator = Validator::make($input, [
            'title' =>'required',
        ]);
        if($validator->fails())
        {
            $data['errors'] = $validator->errors()->all();
            return ['status'=>0,'data'=>$data];
        }

        $tag = Tag::create($input);
        $data['tag'] = $tag;
        return['status'=>1,'data'=>$data];
    }
    public function update(Request $request , $id)
    {
        $input = $request->all();
        $tag = Tag::find($id);
        if($tag){
            $tag->update($input);
            $data['tag'] = $tag;
            return['status'=>1,'data'=>$data];
        }
        return ['status'=>-1 , 'message'=>trans('messages.not_found')];
    }
    public function delete($id)
    {
        $tag = Tag::find($id);
        if($tag){
            $tag->delete();
            return['status'=>1,'mesage'=>trans("messages.delete_done")];
        }
        return ['status'=>-1 , 'message'=>trans('messages.not_found')];
    }
}
