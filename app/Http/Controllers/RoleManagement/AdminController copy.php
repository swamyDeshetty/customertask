<?php

namespace App\Http\Controllers\RoleManagement;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // public



        //

    public function fetchData()
    {
        return view('Roles.admin.admin',compact('data'));
    }


    //Fetching the data using the Jquery
    // public function fetchData()
    // {
    //     $data = Role::all(); // Fetch all roles from the database.
    //     // return view('Roles.admin.admin',compact('data'));
    //     return response()->json([
    //         'data'=>$data,
    //     ]);
    // }

    public function destroy($id)
    {
        // Find the user by ID and delete it
        $user = Role::findOrFail($id);
        $user->delete();

        // Redirect back or to another page after deletion
        return redirect()->back()->with('success', 'User deleted successfully');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'profile' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048', // Temporarily comment this line
            'password' => 'required|max:12|min:5',
        ]);
    
        if ($validator->fails()) 
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        else
        {
            $user = new Role;
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            $image_path = $request->file('profile')->store('images', 'public');
            
            $user->profile = $image_path;
            $user->password = $request->input('password');
            $user->save();
            return response()->json([
                'status' => 200,
                'message' => 'User added Successfully',
            ]);

        };

      
    }
    
    
}
