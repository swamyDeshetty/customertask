<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
   
    //Home page index function
    public function index()
    {
        $student = Student::all();
        return view('crud.index', compact('student'));
    }
    
// 
    public function create()
    {
        return view('crud.create');
    }
   

    //Storing the data in the database...

    public function store(Request $request)
    {
        $storeData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|numeric',
            'password' => 'required|max:255',
        ]);
        $student = Student::create($storeData);
        return redirect('/students')->with('completed', 'Student has been saved!');
    }

    // Edit the Data....
   
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('crud.edit', compact('student'));
    }
   
    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|numeric',
            'password' => 'required|max:255',
        ]);
        Student::whereId($id)->update($updateData);
        return redirect('/crud')->with('completed', 'Student has been updated');
    }
    
    // Delete the data....
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect('/crud')->with('completed', 'Student has been deleted');
    }
}