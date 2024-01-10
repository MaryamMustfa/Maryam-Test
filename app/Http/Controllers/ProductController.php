<?php

namespace App\Http\Controllers;

use illuminate\Validation\Rule;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    Public function index(){
          // according to task 1
        $message = "Welcome to the Product API";

        return response()->json(['message'=> $message]);
            // according to task 2
        $products= Product::all();
        return response()->json(['data' => ProductResource::collection($products)], 200);
    }
 //  for displaying a sing product by id

    public function show($id){

        $product= Product::find($id);

        if(!$product){

            return response()->json(['error'=>'Product Not Found'], 404);

        }
        return response()->json(['data' => new ProductResource($product)], 200);
    }

    // for creating a product

    public function store(Request $request){

    $request->validate([
        'name' => 'required|string',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
    ]);

    $product = Product::create($request->all());

    return response()->json(['data' => new ProductResource($product)], 201);

    }

// for updatig a product 
    public function update (Request $request, $id){

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $product = Product::find($id);
         if(!$product){
            return response()->json(['error'=> 'Product Not Found'], 404);
         }

         $product->update($request->all());

         return response()->json(['data' => new ProductResource($product)], 200);
    }

    // for deleting a product 
   public function destroy($id){

    $product = Product::find($id);
    if(!$product){

        return response()->json(['error' => 'Product Not Found'], 404);

    }
   $product->delete();
   return response()->json(['message' => 'Product Deleted Successsfully'], 200);

}

// for task 3

public function getSortedByPrice()
{
    $products = Product::orderBy('price', 'asc')->get();

    return response()->json(['data' => ProductResource::collection($products)], 200);
}


}
