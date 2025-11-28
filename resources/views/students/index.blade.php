@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 px-6">

        {{-- Page Header --}}
        <div class="flex items-center justify-between mb-8 px-4 py-3 bg-indigo-600 rounded-xl shadow">
            <h2 class="text-3xl font-bold text-white">📘 Students</h2>

            <a href="{{ route('students.create') }}"
                class="inline-flex items-center px-4 py-2 bg-white text-indigo-700 font-semibold rounded-lg shadow hover:bg-indigo-100 transition">
                + New Registration
            </a>
        </div>


        {{-- Flash Success --}}
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-900 px-4 py-3 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Search Bar --}}
        <div class="bg-white p-5 shadow-md rounded-lg mb-6">
            <form method="GET" action="{{ route('students.index') }}" class="flex gap-3">
                <input type="text" name="q" value="{{ request('q') }}"
                    placeholder="🔍 Search by name or registration number..."
                    class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-2">

                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                    Search
                </button>
            </form>
        </div>

        {{-- Table Container --}}
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Reg No</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Class</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Photo</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($students as $student)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $student->reg_no }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $student->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $student->reg_class ?? '-' }}</td>

                            <td class="px-6 py-4">
                                @if ($student->photo)
                                    <img src="{{ asset('storage/students/' . $student->photo) }}"
                                        class="w-14 h-14 rounded-lg object-cover shadow" alt="photo">
                                @else
                                    <div
                                        class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center text-xs text-gray-400">
                                        No Photo
                                    </div>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right text-sm font-medium space-x-3">

                                <a href="{{ route('students.show', $student) }}"
                                    class="text-indigo-600 hover:text-indigo-800 font-semibold">
                                    View
                                </a>

                                <a href="{{ route('students.edit', $student) }}"
                                    class="text-yellow-600 hover:text-yellow-800 font-semibold">
                                    Edit
                                </a>

                                <form action="{{ route('students.destroy', $student) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this student?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <span class="text-4xl">📭</span>
                                    </div>
                                    <p class="text-lg font-semibold">No students found</p>
                                    <p class="text-sm text-gray-400">Try adjusting your search...</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="p-4">
                {{ $students->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
