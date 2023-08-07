<?php

namespace App\Http\Controllers\RoleManagement;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Role;

class SuperAdminController extends Controller
{
    // public

    public function fetchData()
    {
        $data = Role::all(); // Fetch all roles from the database.
        return view('Roles.superadmin.superadmin',compact('data'));
    }

    public function destroy($id)
    {
        // Find the user by ID and delete it
        $user = Role::findOrFail($id);
        $user->delete();

        // Redirect back or to another page after deletion
        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
