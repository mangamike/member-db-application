<?php 
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller {
    public function index() {
        return Customer::orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'address1' => 'required',
            'address2' => '',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'business_type' => 'required|in:Corporation,LLC,Sole Proprietor,Other',
            'preferred_days' => 'required|array'
        ]);

        $validated['customer_id'] = (string) Str::uuid();

        $customer = Customer::create($validated);

        return response()->json($customer, 201);
    }

    public function show(Customer $customer) {
        return $customer;
    }

    public function update(Request $request, Customer $customer) {
        $validated = $request->validate([
            'name' => 'required',
            'address1' => 'required',
            'address2' => '',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'business_type' => 'required|in:Corporation,LLC,Sole Proprietor,Other',
            'preferred_days' => 'required|array'
        ]);

        $customer->update($validated);

        return response()->json($customer);
    }

    public function destroy(Customer $customer) {
        $customer->delete();
        return response()->json(null, 204);
    }
}
