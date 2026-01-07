<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Events\StudentCreated;
use App\Mail\StudentEnrolledMail;

use  Barryvdh\DomPDF\Facade\Pdf;
class StudentController extends Controller{

    //display all students
    public function index(Request $request){
    $serialNo=1;

    $search = $request->search;
    $course = $request->course;  // filter dropdown e.g. active/inactive

    $students = Student::query()
        ->when($search, function ($query) use ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            });
        })
        ->when($course, function ($query) use ($course) {
            $query->where('course', $course);
        })
         ->orderBy('id', 'desc')
        ->paginate(8);

    $students->appends($request->all());

    return view('students.index', compact('students', 'search', 'course','serialNo'));

    }

    //create new student
    public function create(){
        return view('students.create');
    }

    //store a student data into db
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|digits:10',
            'course' => 'required',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);
        $filename=null;

        if ($request->hasFile('profile_img')) {
        $file = $request->file('profile_img');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/students/', $filename);
    }

        // Cache::put('name', $validated['name'], 60);

        // Create a new student with the validated data
        $student= Student::create(['name' => $validated['name'],'email' => $validated['email'],'phone' => $validated['phone'],'course' => $validated['course'],'profile_img'=>$filename]);

        Mail::to($student->email)->send(new StudentEnrolledMail($student));

          StudentCreated::dispatch($student);

        // Redirect to the students list with a success message
        return redirect('/students')->with('success', 'Student created successfully!');
    }

    public function edit($id){
     $student=Student::findOrFail($id);
        return view('students.edit', compact('student'));
}
    public function update(Request $request,$id){

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'course' => 'required',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $filename=null;
        if ($request->hasFile('profile_img')) {
        $file = $request->file('profile_img');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/students/', $filename);
        }

        $student=Student::findOrFail($id);
        $student->update([
                'name'=>$validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'course' => $validated['course'],
                'profile_img'=>$filename
                ]);
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function destroy($id){

            Student::destroy($id);

        return redirect('/students')->with('success','deleted successfully');
    }

    public function bulkDelete(Request $request){
        $ids=$request->ids;
        if($ids){
            Student::whereIn('id',$ids)->delete();
            return redirect()->route('students.index')->with('success','Selected Students Deleted Successfully');
        }else{
        return redirect()->route('students.index')->with('error',"Select atleast one user");
        }
    }

    public function export(Request $request){
        $serialNo=1;
            $search = $request->search;
            $status = $request->status;
            $course = $request->course;

            $students = Student::query()
                ->when($search, function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                ->when($course, function ($query) use ($course) {
                    $query->where('course', $course);
                })->get();

         $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('students.pdf', compact('students','serialNo'));
         return $pdf->download('students_filtered.pdf');
    }

 }
