<?php

namespace App\Http\Controllers\Pos;

use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function ProductAll(){
        $products = Product::latest()->get();

        return view('backend.product.product_all', compact('products'));
    }

    public function ProductAdd(){

        $suppliers = Supplier::all();
        $categories = Category::all();
        $units = Unit::all();

        return view('backend.product.product_add', compact('suppliers','categories','units'));
    }

    public function ProductStore(Request $request){
        Product::insert([
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'quantity' => '0',
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product inserted successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('product.all')->with($notification);
    }

    public function ProductEdit($id){
        $product = Product::findOrFail($id);
        $suppliers = Supplier::all();
        $categories = Category::all();
        $units = Unit::all();

        return view('backend.product.product_edit', compact('product','suppliers','categories','units'));
    }

    public function ProductUpdate(Request $request){
        $product_id = $request->id;

        Product::findOrFail($product_id)->update([
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product updated successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('product.all')->with($notification);
    }

    public function ProductDelete($id){
        $product = Product::findOrFail($id);

        $product->delete();

        $notification = array(
            'message' => 'Product deleted successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('product.all')->with($notification);
    }
}