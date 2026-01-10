<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::latest()->paginate(10);
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'emp_code'=> 'string|required|unique:teachers,emp_code',
            'name'=> 'string|required|max:50',
            'phone'=> 'string|nullable',
            'designation'=> 'string|nullable',
            'address'=> 'string|nullable',
            'gender'=> 'in:male,female,others',
            'department'=> 'string|nullable',
            'status'=> 'in:active,inactive,suspended',
        ]);

        Teacher::create($data);
        return redirect()->route('teachers.index')->with('success', 'Teacher Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher Deleted Successfully!');
    }
}
