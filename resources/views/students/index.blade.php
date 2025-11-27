@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Students</h2>
        <div class="flex items-center space-x-2">
            <a href="{{ route('students.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded shadow-sm hover:bg-green-700">
                + Add Student
            </a>
        </div>
    </div>

    {{-- flash success --}}
    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- simple search --}}
    <form method="GET" action="{{ route('students.index') }}" class="mb-4">
        <div class="flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by name or reg no"
                   class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Search</button>
        </div>
    </form>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reg No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Class</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($students as $student)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $student->reg_no }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $student->reg_class ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($student->photo)
                                <img src="{{ asset('storage/students/'.$student->photo) }}" class="w-12 h-12 rounded object-cover" alt="photo">
                            @else
                                <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">No</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('students.show', $student) }}" class="text-indigo-600 hover:underline mr-2">View</a>
                            <a href="{{ route('students.edit', $student) }}" class="text-yellow-600 hover:underline mr-2">Edit</a>

                            <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure to delete this student?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">No students found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4 bg-white">
            {{-- preserve query on pagination --}}
            {{ $students->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
