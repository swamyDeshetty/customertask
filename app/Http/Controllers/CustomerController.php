<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    // Custom form
    public function index()
    {
        return view('customer_form');
    }


// store the customer form data in the db
    public function store(Request $request)
    {
        // Validating the form data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone' => 'required|string|unique:customers,phonenumber|size:10',
            'email' => 'required|string|email|max:50|unique:customers,email',
            'date_of_birth' => 'required|date',
        ]);

        // Merging first name and last name into the 'name' field
        $name = $request->input('first_name') . ' ' . $request->input('last_name');

        // Create and save the customer
        $customer = new Customer();
        $customer->name = $name;
        $customer->email = $request->input('email');
        $customer->phonenumber = $request->input('phone');
        $customer->date_of_birth = $request->input('date_of_birth');
        $customer->save();

        return redirect('/display')->with('success', 'Customer created successfully!');
    }

    //  displaying the list of customers
    public function display()
    {
        $data = Customer::all();
        return view('customer_list',compact('data'));
    }
    
    // filter module 
    public function filter(Request $request)
    {
    
        $selectedDate = $request->input('selected_date');

        $data = Customer::whereDate('created_at', '=', $selectedDate)->get(); // if searched date and the dob of any customer is equal we need to fetch the data

        return view('customer_list', compact('data'));
    }

    // editing customers

   
    public function show(Customer $customer)
    {
        return view('edit_form', compact('customer'));
    }
    
    //  update module
    
    public function update(Request $request, $customerId)
    {
       
        $customer = Customer::findOrFail($customerId);

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        // Update the 'name' field with the first name and last name
        $customer->name = $first_name . ' ' . $last_name;
        
        $customer->email = $request->input('email');

        $customer->save();

        return redirect('display')->with('success', 'Customer updated successfully');
    }
    


}
