@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Student</h2>
        <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="reg_no">Registration Number</label>
                <input type="text" name="reg_no" id="reg_no" value="{{ old('reg_no', $student->reg_no) }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" id="dob" value="{{ old('dob', $student->dob) }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $student->phone) }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $student->email) }}" class="form-control">
            </div>
            <div class "form-group">
                <label for = "class_id">Class</label>
                <!-- Add dropdown or other input for selecting the class -->
                <!-- Example: -->
                <!--
                    @foreach ($classRooms as $classRoom)
                        @if ($classRoom->id == $student->class_id)
                            selected
                        @endif
                    @endforeach
                 -->
                 <!-- Add dropdown or other input for selecting the class -->
                 <!-- Example: -->
                 <!--
                     @foreach ($classRooms as $classRoom)
                         @if ($classRoom->id == $student->class_id)
                             selected
                         @endif
                     @endforeach
                  -->
                 <!-- Add dropdown or other input for selecting the class -->
                 <!-- Example: -->
                 <!--
                     @foreach ($classRooms as $classRoom)
                         @if ($classRoom->id == $student->class_id)
                             selected
                         @endif
                     @endforeach
                  -->

                 <!-- Add dropdown or other input for selecting the class -->
                 <!-- Example: -->
                 <!--
                     @foreach ($classRooms as $classRoom)
                         @if ($classRoom->id == $student->class_id)
                             selected
                         @endif
                     @endforeach
                  -->

                 <!-- Add dropdown or other input for selecting the class -->
                 <!-- Example: -->
                 <!--
                     @foreach ($classRooms as $classRoom)
                         @if ($classRoom->id == $student->class_id)
                             selected
                         @endif
                     @endforeach
                  -->

                 <!-- Add dropdown or other input for selecting the class -->
                 <!-- Example: -->
                 <!--
                     @foreach ($classRooms as $classRoom)
                         @if ($classRoom->id == $student->class_id)
                             selected
                         @endif
                     @endforeach
                  -->

                 <!-- Add dropdown or other input for selecting the class -->
                 <!-- Example: -->
                 <!--
                     @foreach ($classRooms as $classRoom)
                         @if ($classRoom->id == $student->class_id)
                             selected
                         @endif
                     @endforeach
                  -->

             </div>

             <button type = "submit">Update Student</button>

         </form>

     </div>

@endsection
