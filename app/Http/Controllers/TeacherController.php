<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller{

    public function index(){
        $serialNo=1;
        $teachers=Teacher::orderBy('id','desc')->paginate(8);
        return view('teachers.index',compact('teachers','serialNo'));
    }
    public function create(){
        return view('teachers.create');
    }
    public function store(Request $request){
        $validated =$request->validate([
            'name'=>'required|min:2',
            'email'=>'required|email|unique:teachers,email',
            'phone'=>'required|digits:10',
            'specialization'=>'required',
            'salary'=>'required|digits:5'
        ]);
        //Creeate new teacher
        DB::insert("INSERT INTO teachers(name,email,phone,specialization,salary) VALUES(?,?,?,?,?)",
        [$validated['name'],$validated['email'],$validated['phone'],$validated['specialization'],$validated['salary']]);

        return redirect('/teachers')->with('success','Teacher Created Succesfully');
    }
    public function updateStatus(Request $request, $id){
        DB::table('teachers')->where('id', $id)->update([
        'status' => $request->status
    ]);
     return redirect()->back()->with('success', 'Status updated successfully');
    }

    public function edit($id){
        $teacher=DB::selectOne("SELECT * FROM teachers WHERE id=?",[$id]);
        return view('teachers.edit',compact('teacher'));
    }
    public function update(Request $request,$id){
        $validated=$request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|digits:10',
            'specialization'=>'required',
            'salary'=>'required|digits:5'
        ]);
        DB::update("UPDATE teachers SET name = ?, email = ?, phone = ?, specialization = ?, salary = ?, updated_at = ? WHERE id = ?",
                 [$validated['name'],$validated['email'],$validated['phone'],$validated['specialization'],$validated['salary'],now(),$id]);
        return redirect('/teachers');
    }

    public function destroy($id){
        DB::delete("DELETE FROM teachers where id=?",[$id]);

        return  redirect('/teachers')->with('success','Teacher Deleted Successfully');
    }
}
