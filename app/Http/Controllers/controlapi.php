<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\Validator;
class controlapi extends Controller
{
    public function display($id=null)
    {
      return $id? product::find($id): product::all();
    }
    public function create(Request $res)
    {
        $rules=array(
          "price"=>"required|min:3|max:4"
        );
        $validator= Validator::make($res->all(),$rules);
        if($validator->fails())
        {
          return response()->json($validator->errors(),401);
        }
        else
        {
        $product=new product();
        $product->name=$res->name;
        $product->price=$res->price;
        $product->category=$res->category;
        $product->description=$res->description;
        $product->sub_galary=$res->sub_galary;
        $result=$product->save();
        return $result?"added":"not added";

        }
         
    }
    public function update(Request $res)
    {
      $product= product::find($res->id);
      $product->name=$res->name;
      $product->price=$res->price;
      $product->category=$res->category;
      $product->sub_galary=$res->sub_galary;
      $result=$product->save();
      return $result?"updated":"not updated";
    }
    public function delete($id)
    {
      $result= product::where("id",$id)->delete();
      return $result?"deleted":"not deleted";
    }
    public function search($name)
    {
        $result=product::where("name","like","%".$name."%")->get();
        if($result)
        {
            return $result;
        }
        else
        {
            return "not found";
        }
    }
    public function upload(Request $req)
    {
      $result=$req->file('file')->store('apidocs');
      return ["resut"=> $result];
    }
}
