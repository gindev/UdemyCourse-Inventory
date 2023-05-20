<?php

namespace App\Http\Controllers\Pos;

use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function PurchaseAll(){
        $purchases = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->get();

        return view('backend.purchase.purchase_all', compact('purchases'));
    }

    public function PurchaseAdd(){
        $suppliers = Supplier::all();
        $units = Unit::all();
        $categories = Category::all();

        return view('backend.purchase.purchase_add', compact('suppliers', 'units', 'categories'));
    }

    public function PurchaseStore(Request $request){
        //dd($request->all());
        if($request->prodCatId == null){

            $notification = array(
                'message' => 'There is no Category selected.',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        } else {
            for ($i = 0; $i < count($request->prodCatId); $i++) { 
                $purchase = new Purchase();

                $purchase->supplier_id = $request->prodSupId[$i];
                $purchase->category_id = $request->prodCatId[$i];
                $purchase->product_id = $request->prodId[$i];
                $purchase->number = $request->purchNumber;
                $purchase->date = date('Y-m-d', strtotime($request->purchDate));
                $purchase->description = $request->purchaseDesc[$i];
                $purchase->qty = $request->unitCount[$i];
                $purchase->single_price = $request->unitPrice[$i];
                $purchase->total_price = $request->purchaseTotal[$i];
                $purchase->status = '0';
                $purchase->created_by = Auth::user()->id;
                $purchase->save();
            }
        }

        $notification = array(
            'message' => 'Purchase created successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function PurchaseDelete($id){
        Purchase::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Purchased item deleted successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function PurchasePending(){
        $purchases = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0')->get();

        return view('backend.purchase.purchase_pending', compact('purchases'));
    }

    public function PurchaseApprove($id){
        $purchase = Purchase::findOrFail($id);
        $product = Product::where('id', $purchase->product_id)->first();

        $product->quantity += ((float)($purchase->qty));

        if($product->save()){
            Purchase::findOrFail($id)->update([
                'status' => 1,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Purchased item approved successfully',
                'alert-type' => 'success',
            );
    
            return redirect()->route('purchase.all')->with($notification);
        }
    }
}