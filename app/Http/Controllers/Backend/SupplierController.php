<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function AllSupplier() {
        $supplier = Supplier::latest()->get();
        return view('admin.backend.supplier.all_supplier', compact('supplier'));
    } // End Method

    public function AddSupplier() {
        return view('admin.backend.supplier.add_supplier');
    } // End Method

    public function StoreSupplier(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:ware_houses,email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        Supplier::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        $notification = array(
            'message' => 'Supplier inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.supplier')->with($notification);
    } // End Method

    public function EditSupplier($id){
        $supplier = Supplier::find($id);
        return view('admin.backend.supplier.edit_supplier', compact('supplier'));
    } // End Method

    public function UpdateSupplier(Request $request) {
        $supplier_id = $request->id;
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:ware_houses,email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        Supplier::find($supplier_id)->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        $notification = array(
            'message' => 'Supplier updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.supplier')->with($notification);
    } // End Method

    public function DeleteSupplier($id) {
        Supplier::find($id)->delete();
        $notification = array(
            'message' => 'Supplier deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method
}