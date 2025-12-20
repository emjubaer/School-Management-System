<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::latest()->paginate(8);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'reg_no' => 'required|unique:students,reg_no,',
            'name' => 'required|string|max:255',
            'dob' => 'date|nullable',
            'phone' => 'string|nullable',
            'email' => 'string|email|nullable',
            'class' => 'integer|required',
            'address' => 'string|nullable',
            'photo' => 'image|nullable|mimes:jpeg,jpg,png,gif|max:2048',

        ]);

        /* if ($request->hasFile('photo')){
            $file = $request->file('photo');
            $fileName = time()."_".$file->getClientOriginalName();
            $file->storeAs('public/students', $fileName);
            $data['photo'] = $fileName;
        } */

       $data['photo'] = $this->handlePhotoUpload($request, null);

        Student::create($data);
        return redirect()->route('students.index')->with('success', 'Student Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view ('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
         return view ('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
         $data = $request->validate([
            'reg_no' => 'required|unique:students,reg_no,',
            'name' => 'required|string|max:255',
            'dob' => 'date|nullable',
            'phone' => 'string|nullable',
            'email' => 'string|email|nullable',
            'class' => 'integer|required',
            'address' => 'string|nullable',
            'photo' => 'image|nullable|mimes:jpeg,jpg,png,gif|max:2048',

        ]);
       /* if ($request->hasFile('photo')){
            if ($student->photo){
                Storage::delete('public/students'. $student->photo);
            }
            $file = $request->file('photo');
            $fileName = time()."_".$file->getClientOriginalName();
            $file->storeAs('public/students', $fileName);
            $data['photo'] = $fileName;
        } */

            $data['photo'] = $this->handlePhotoUpload($request, $student);

        $student->update($data);
        return redirect()->route('students.index')->with('success', "Student Information Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        if ($student->photo){
            Storage::delete('public/students/'.$student->photo);
        }

        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student Deleted Successfully!');
    }

    private function handlePhotoUpload(Request $request, $student = null){
        if ($request->hasFile('photo')){
            if ($student && $student->photo){
                Storage::delete('public/students/'.$student->photo);
            }

            $file = $request->file('photo');
            $fileName = time()."_".$file->getClientOriginalName();
            $file->storeAs('public/students', $fileName);
            return $fileName;
        }

        return $student ? $student->photo : null;
    }
}
