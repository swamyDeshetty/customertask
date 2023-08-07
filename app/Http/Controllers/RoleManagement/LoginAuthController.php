<?php

namespace App\Http\Controllers\RoleManagement;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;

class loginAuthController extends Controller
{
    //
    public function login()
    {
        return view("Roles.login");

    }
    public function registration()
    {

        return view("Roles.registration");
    }


    public function RegisterUser(Request $request)
    {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'profile' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'password' => 'required|max:12|min:5'
            ]);

            // Save the profile image to the storage folder
            $image_path = $request->file('profile')->store('images', 'public');

            // saving the data into the db..
            $user = new Role();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->profile = $image_path; // Save the file path to the 'profile' field in the database.

            $res = $user->save(); // Save the data into the db.

            if ($res) {
                return back()->with('success', 'You have registered successfully');
            } else {
                // Handle the case when the user cannot be saved to the database
                // Delete the profile image from storage to avoid unused files
                Storage::delete('public/' . $image_path);

                return back()->with('fail', 'Something went wrong');
            }
    } 
    // login user  

        public function loginUser(Request $request)
        {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|max:12|min:5',
            ]);
        
            // Find the user by their email in the "roles" table
            $user = Role::where('email', $request->email)->first();
        
            if ($user) {
                // Check if the entered password matches the hashed password in the database
                if (Hash::check($request->password, $user->password)) {
                    $request->session()->put('loginId',$user->id);
                    // Assuming that 'role' is a column in the 'roles' table representing the user's role
                    if ($user->role === 'admin') {
                        // Assuming you have a route named 'admin' defined in your routes/web.php
                        return redirect('admin');
                    } elseif ($user->role === 'superadmin') {
                        // Assuming you have a route named 'superadmin' defined in your routes/web.php
                        return redirect('superadmin');
                    } else {
                        // Handle other roles or redirect to a default route for regular users
                        return redirect('');
                    }
                } else {
                    return back()->with('fail', "This password does not match");
                }
            } else {
                return back()->with('fail', "This email is not registered");
            }
        }


    public function dashboard()
    {
        $data= array();
        if (Session::has('loginId')){
            $data= User::where('id','=', Session::get('loginId'))->first();
        }
        // echo $data;
        // exit;
        return view('auth.dashboard',compact('data')); //passing the id into the view using the compact method..
    }

    // logout
    public function logout()
    {
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('custom-login');
        }
    }

    public function new()
    {
       
        return view('newlayout/newpage');
     }

    }