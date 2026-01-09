<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassRoom;

class ClassRoomController extends Controller
{
    public function index()
    {
        $classRooms = ClassRoom::latest()->paginate(8);
        return view('classRooms.index', compact('classRooms'));
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string|nullable',
            'status' => 'in:active,inactive',
        ]);

        ClassRoom::create($data);
        return redirect()->route('classrooms.index')->with('success', 'Class Room Created Successfully!');
    }

    public function destroy(ClassRoom $classRoom)
    {
      if ($classRoom->students()->exists()) {
        return redirect()->back()
            ->with('error', 'Cannot delete class. Students are assigned!');

        }
        //$classRoom->students()->update(['class_id' => null]);
        $classRoom->delete();
        return redirect()->route('classrooms.index')->with('success', 'Class Deleted Successfully!');
    }


}
