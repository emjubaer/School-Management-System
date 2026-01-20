@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

            <!-- LEFT SIDE : CREATE SUBJECT -->
            <div class="md:col-span-5 bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="border-b px-5 py-3 font-semibold text-gray-700 dark:text-gray-200">
                    Create Subject
                </div>

                <div class="p-5">
                    <form action="{{ route('subjects.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <!-- Class -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">
                                Class
                            </label>
                            <select name="class_room_id"
                                class="w-full mt-1 rounded-md border-gray-300 dark:border-gray-700
                                   dark:bg-gray-900 dark:text-white focus:ring focus:ring-indigo-200"
                                required>
                                <option value="">Select Class</option>
                                @foreach ($classRooms as $classRoom)
                                    <option value="{{ $classRoom->id }}"
                                        {{ old('class_room_id') == $classRoom->id ? 'selected' : '' }}>
                                        {{ $classRoom->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_room_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subject Code -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">
                                Subject Code
                            </label>
                            <input type="text" name="sub_code" value="{{ old('sub_code') }}"
                                class="w-full mt-1 rounded-md border-gray-300 dark:border-gray-700
                                   dark:bg-gray-900 dark:text-white focus:ring focus:ring-indigo-200"
                                required>
                            @error('sub_code')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subject Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">
                                Subject Name
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full mt-1 rounded-md border-gray-300 dark:border-gray-700
                                   dark:bg-gray-900 dark:text-white focus:ring focus:ring-indigo-200"
                                required>
                            @error('name')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Full Mark -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">
                                Full Mark
                            </label>
                            <input type="number" name="fullmark" value="{{ old('fullmark') }}"
                                class="w-full mt-1 rounded-md border-gray-300 dark:border-gray-700
                                   dark:bg-gray-900 dark:text-white focus:ring focus:ring-indigo-200"
                                required>
                            @error('fullmark')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pass Mark -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">
                                Pass Mark
                            </label>
                            <input type="number" name="pass_mark" value="{{ old('pass_mark') }}"
                                class="w-full mt-1 rounded-md border-gray-300 dark:border-gray-700
                                   dark:bg-gray-900 dark:text-white focus:ring focus:ring-indigo-200"
                                required>
                            @error('pass_mark')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">
                                Description
                            </label>
                            <textarea name="description" rows="3"
                                class="w-full mt-1 rounded-md border-gray-300 dark:border-gray-700
                                   dark:bg-gray-900 dark:text-white focus:ring focus:ring-indigo-200">{{ old('description') }}</textarea>
                        </div>

                        <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-md">
                            Create Subject
                        </button>
                    </form>
                </div>
            </div>

            <!-- RIGHT SIDE : CLASS WISE SUBJECT LIST -->
            <div class="md:col-span-7 bg-white dark:bg-gray-800 rounded-lg shadow">
                <div
                    class="border-b border-gray-200 dark:border-gray-700
               px-5 py-3 font-semibold
               text-gray-800 dark:text-gray-100">
                    Class Wise Subjects
                </div>

                <div class="p-5 space-y-6">
                    @foreach ($classRooms as $classRoom)
                        <div>
                            <!-- Class Name -->
                            <h3 class="text-indigo-600 dark:text-indigo-400 font-semibold mb-2">
                                {{ $classRoom->name }}
                            </h3>

                            @if ($classRoom->subjects->count())
                                <div class="overflow-x-auto">
                                    <table
                                        class="w-full text-sm border border-gray-300 dark:border-gray-700
                                            text-gray-800 dark:text-gray-100">

                                        <thead class="bg-gray-100 dark:bg-gray-700">
                                            <tr>
                                                <th class="border border-gray-300 dark:border-gray-600 px-3 py-2">
                                                    Code
                                                </th>
                                                <th class="border border-gray-300 dark:border-gray-600 px-3 py-2">
                                                    Subject
                                                </th>
                                                <th class="border border-gray-300 dark:border-gray-600 px-3 py-2">
                                                    Full Mark
                                                </th>
                                                <th class="border border-gray-300 dark:border-gray-600 px-2 py-2">
                                                    Pass Mark
                                                </th>
                                                <th class="border border-gray-300 dark:border-gray-600 px-2 py-2">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($classRoom->subjects as $subject)
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                                    <td class="border border-gray-300 dark:border-gray-600 px-3 py-2">
                                                        {{ $subject->sub_code }}
                                                    </td>
                                                    <td class="border border-gray-300 dark:border-gray-600 px-3 py-2">
                                                        {{ $subject->name }}
                                                    </td>
                                                    <td class="border border-gray-300 dark:border-gray-600 px-3 py-2">
                                                        {{ $subject->fullmark }}
                                                    </td>
                                                    <td class="border border-gray-300 dark:border-gray-600 px-3 py-2">
                                                        {{ $subject->pass_mark }}
                                                    </td class="border border">
                                                    <td>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    No subjects created yet
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>


        </div>
    </div>
@endsection
