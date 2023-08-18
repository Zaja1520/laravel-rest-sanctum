<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductController extends Controller
{
    public function allProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function createProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        return Product::create($request->all());
        
    }

    public function productInfo(Request $request, $id)
    {
        // find product info by id
        $product = Product::find($id);
        return response()->json($product);
    }

    public function updateProduct(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'slug' =>'required',
            'description' =>'required',
            'price' =>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        // find product id  and modify data
        $product = Product::find($id);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        return response()->json($product);
    }
}
