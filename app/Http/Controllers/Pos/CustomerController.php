<?php

namespace App\Http\Controllers\Pos;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    public function CustomerAll(){
        $customers = Customer::latest()->get();
        return view('backend.customer.customer_all', compact('customers'));
    }

    public function CustomerAdd(){
        return view('backend.customer.customer_add');
    }

    public function CustomerStore(Request $request){
        $image = $request->file('customer_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $save_url = "upload/customer/".$name_gen;
        Image::make($image)->resize(200,200)->save($save_url);
        
        Customer::insert([
            'name' => $request->name,
            'customer_image' => $save_url,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'address' => $request->address,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Customer added successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('customer.all')->with($notification);
    }

    public function CustomerEdit($id){
        $customer = Customer::findOrFail($id);
        return view('backend.customer.customer_edit', compact('customer'));
    }

    public function CustomerUpdate(Request $request){
        $customer_id = $request->id;

        $save_url = Customer::findOrFail($customer_id)->customer_image;

        if($request->file('customer_image')){
            unlink($save_url);
            $image = $request->file('customer_image');
            $save_url = 'upload/customer/'.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(200,200)->save($save_url);
        }

        Customer::findOrFail($customer_id)->update([
            'name' => $request->name,
            'customer_image' => $save_url,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'address' => $request->address,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Customer updated successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('customer.all')->with($notification);
    }

    public function CustomerDelete($id){

        $customer = Customer::findOrFail($id);

        unlink($customer->customer_image);
        $customer->delete();

        $notification = array(
            'message' => 'Customer deleted successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('customer.all')->with($notification);
    }
}
