<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function get()
    {
        $data = Product::all();

        return response()->json(
            [
                "message" => "Success",
                "data" => $data
            ]
        );
    }
    
    public function getById($id)
    {
        $product = Product::where('id', $id)->first();
        if($product){
            return response()->json(
                [
                    "message" => "Success",
                    "data" => $product
                ]
            );
        }
        return response()->json(
            [
                "message" => "Tidak ada produk dengan id: ". $id ." dalam database"
            ],
            400
        );
    }

    public function post(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->active = $request->active;
        $product->description = $request->description;

        $product->save();
        
        return response()->json(
            [
                "message" => "Success",
                "data" => $product
            ]
        );
    }

    public function put(Request $request, $id)
    {   
        $product = Product::where('id', $id)->first();
        if($product){
            $product->name = $request->name ? $request->name : $product->name;
            $product->price = $request->price ? $request->price : $product->price;
            $product->quantity = $request->quantity ? $request->quantity : $product->quantity;
            $product->active = $request->active ? $request->active : $product->active;
            $product->description = $request->description ? $request->description : $product->description;

            $product->save();
            return response()->json(
                [
                    "message" => "PUT Method Success "
                ]
            );
        }
        return response()->json(
            [
                "message" => "PUT Method Failed, Product with id: " . $id . " not found,"
            ],
            400
        );
    
    }
    
    public function delete($id)
    {
        $product = Product::where('id', $id)->first();
        if($product){
            $product->delete();
            return response()->json(
                [
                    "message" => "DELETE Method Success " . $product
                ]
            );
        }
        return response()->json(
            [
                "message" => "DELETE Method Failed, Product with id: " . $id . " not found,"
            ],
            400
        );
    }
}
