<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function AllCustomer() {
        $customer = Customer::latest()->get();
        return view('admin.backend.customer.all_customer', compact('customer'));
    } // End Method

    public function AddCustomer() {
        return view('admin.backend.customer.add_customer');
    } // End Method

    public function StoreCustomer(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        Customer::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        $notification = array(
            'message' => 'Customer inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.customer')->with($notification);
    } // End Method

    public function EditCustomer($id){
        $customer = Customer::find($id);
        return view('admin.backend.customer.edit_customer', compact('customer'));
    } // End Method

    public function UpdateCustomer(Request $request) {
        $customer_id = $request->id;
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        Customer::find($customer_id)->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        $notification = array(
            'message' => 'Customer updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.customer')->with($notification);
    } // End Method

    public function DeleteCustomer($id) {
        Customer::find($id)->delete();
        $notification = array(
            'message' => 'Customer deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method
}