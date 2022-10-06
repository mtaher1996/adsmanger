<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\CategoryResources\CategoryResourceV2;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::get();
        $data['categories'] = CategoryResourceV2::collection($categories);
        return['status'=>1,'data'=>$data];
    }

    public function get($id)
    {
        $category = Category::find($id);
        $data['category'] = new CategoryResourceV2($category);
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

        $category = Category::create($input);
        $data['category'] = $category;
        return['status'=>1,'data'=>$data];
    }
    public function update(Request $request , $id)
    {
        $input = $request->all();
        $category = Category::find($id);
        if($category){
            $category->update($input);
            $data['category'] = $category;
            return['status'=>1,'data'=>$data];
        }
        return ['status'=>-1 , 'message'=>trans('messages.not_found')];
    }
    public function delete($id)
    {
        $category = Category::find($id);
        if($category){
            $category->delete();
            return['status'=>1,'mesage'=>trans("messages.delete_done")];
        }
        return ['status'=>-1 , 'message'=>trans('messages.not_found')];
    }
}
