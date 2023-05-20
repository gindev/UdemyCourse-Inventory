<?php

namespace App\Http\Controllers\Pos;

use App\Models\Unit;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DefaultController extends Controller
{
    public function GetCategory(Request $request){
        $supplier_id = $request->supplier_id;

        //dd($supplier_id);

        $categories = Product::with(['category'])->select('category_id')->where('supplier_id', $supplier_id)->groupBy('category_id')->get();
        //dd($categories);
        return response()->json($categories);
    }

    public function GetProduct(Request $request){
        $category_id = $request->category_id;
        $supplier_id = $request->supplier_id;

        $products = Product::where([
            ['supplier_id', $supplier_id],
            ['category_id', $category_id],
        ])->get();

        if($request->product_id){
            $product = $products->find($request->product_id);
            return response()->json($product);
        }
        return response()->json($products);
    }
}
