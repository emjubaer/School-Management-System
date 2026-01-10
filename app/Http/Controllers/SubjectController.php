<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classRooms = ClassRoom::all();
        $subjects = Subject::latest()->paginate(10);
        return view('subjects.index', compact('subjects', 'classRooms'));
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
            'class_room_id' => 'required|exists:class_rooms,id',
            'sub_code' => 'required|unique:subjects,sub_code|max:10',
            'name' => 'required|max:255',
            'fullmark' => 'required|numeric',
            'pass_mark' => 'required|numeric',
            'description' => 'nullable|string',
        ]);


            Subject::create([
                'class_room_id' =>$request->class_room_id,
                'sub_code' =>$request->sub_code,
                'name' => $request->name,
                'fullmark' => $request->fullmark,
                'pass_mark' => $request->pass_mark,
                'description' => $request->description,
            ]);

        return redirect()->route('subjects.index')->with('success', 'Subjects created successfully.');
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
    public function destroy(string $id)
    {
        //
    }
}
