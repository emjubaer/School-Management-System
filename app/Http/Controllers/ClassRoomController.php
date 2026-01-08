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
            'name' => 'required|string|max:255|unique:class_rooms,name',
            'description' => 'string|nullable',
            'status' => 'in:active,inactive',
        ]);

        ClassRoom::create($data);
        return redirect()->route('classRooms.index')->with('success', 'Class Room Created Successfully!');
    }

    public function destroy(ClassRoom $classRoom)
    {
        $classRoom->delete();
        return redirect()->route('classRooms.index')->with('success', 'Class Room Deleted Successfully!');
    }


}
