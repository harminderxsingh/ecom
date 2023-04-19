<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductController extends Controller
{
    //


    public function productAdd(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required',
            'price' => 'required',
            'cost' => 'required',
            'unit' => 'required',
            'weight' => 'required',
            'thumbnail' => 'required',
            'images' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'Validation Error'
            ]);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->slug = \Str::slug($request->name) . '-' . time();
        $product->price = $request->price;
        $product->cost = $request->cost;
        $product->description = $request->description;
        $product->unit = $request->unit;
        $product->weight = $request->weight;
        $product->thumbnail = $request->thumbnail;
        $product->images = json_encode($request->images);
        $product->save();
        if ($product) {
            return response()->json(["statusCode" => 200, "msg" => "Product added"]);
        } else {
            return response()->json(["statusCode" => 404, "message" => "Error occurred"]);
        }
    }
    public function productList(Request $request)
    {
        $data = Product::get();
        if ($data) {
            return response()->json(["statusCode" => 200, "data" => $data]);
        } else {
            return response()->json(["statusCode" => 404, "message" => "No data found"]);
        }
    }
}
