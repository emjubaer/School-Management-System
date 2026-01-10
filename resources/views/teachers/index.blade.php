@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-8 px-4">

        {{-- =====================
        PAGE HEADER
    ===================== --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-white">🏫 Teacher List</h1>

            <button id="openClassModal"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                + Add Teacher
            </button>
        </div>

        {{-- =====================
        SUCCESS MESSAGE
    ===================== --}}
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        {{-- =====================
        ERROR MESSAGE
    ===================== --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- =====================
        TABLE
    ===================== --}}
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">Emp. Code</th>
                        <th class="px-6 py-3 text-left font-semibold">Teacher Name</th>
                        <th class="px-6 py-3 text-left font-semibold">Phone</th>
                        <th class="px-6 py-3 text-left font-semibold">Designation</th>
                        <th class="px-6 py-3 text-left font-semibold">Status</th>
                        <th class="px-6 py-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($teachers as $teacher)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium">
                                {{ $teacher->emp_code }}
                            </td>

                            <td class="px-6 py-4 font-medium">
                                {{ $teacher->name }}
                            </td>

                            <td class="px-6 py-4 font-medium">
                                {{ $teacher->phone }}
                            </td>

                            <td class="px-6 py-4 font-medium">
                                {{ $teacher->designation }}
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    class="px-2 py-1 rounded text-sm
                                {{ $teacher->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($teacher->status) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-right space-x-3">
                                <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Delete this Teacher?');">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-600 hover:text-red-800 font-semibold">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-0"> <!-- colspan=6 because table has 6 columns -->
                                <div class="flex flex-col items-center justify-center h-64 w-full text-gray-400">
                                    <!-- Optional Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 17v-6h6v6m2 4H7a2 2 0 01-2-2V7a2 2 0 012-2h6l4 4v10a2 2 0 01-2 2z" />
                                    </svg>
                                    <span class="text-lg font-medium">No Teachers found</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            <div class="p-4">
                {{ $teachers->appends(request()->query())->links() }}
            </div>
        </div>
    </div>



    {{-- =========================
     MODAL : CREATE Teacher
========================= --}}
    <div id="classModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">

        <div class="bg-white p-6 rounded-xl shadow-xl w-[600px] w">
            <h2 class="text-xl font-bold mb-5 text-center">Create Teacher</h2>

            <form method="POST" action="{{ route('teachers.store') }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="font-semibold">Emp. Code</label>
                        <input type="text" name="emp_code" placeholder="Employee Code"
                            class="w-full p-2 border rounded focus:ring focus:ring-indigo-200" required>
                    </div>

                    <div>
                        <label class="font-semibold">Phone</label>
                        <input type="tel" name="phone" maxlength="11" placeholder="01XXXXXXXXX"
                            class="w-full p-2 border rounded focus:ring focus:ring-indigo-200">
                    </div>


                </div>

                <div>
                    <label class="font-semibold">Teacher Name</label>
                    <input type="text" name="name" class="w-full p-2 border rounded focus:ring focus:ring-indigo-200"
                        required>
                </div>

                <div>
                    <label class="font-semibold">Designation</label>
                    <input type="text" name="designation"
                        class="w-full p-2 border rounded focus:ring focus:ring-indigo-200" required>
                </div>

                <div>
                    <label class="font-semibold">Address</label>
                    <textarea name="address" class="w-full p-2 border rounded" rows="2"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="font-semibold">Gender</label>
                        <select name="gender" class="w-full p-2 border rounded focus:ring focus:ring-indigo-200">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        </select>
                    </div>

                    <div>
                        <label class="font-semibold">Department</label>
                        <input type="text" name="department"
                            class="w-full p-2 border rounded focus:ring focus:ring-indigo-200" required>
                    </div>
                </div>


                <div>
                    <label class="font-semibold">Status</label>
                    <select name="status" class="w-full p-2 border rounded focus:ring focus:ring-indigo-200">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="suspended">Suspended</option>
                    </select>
                </div>

                <div class="flex gap-4 pt-2">
                    <button type="submit" class="bg-green-600 text-white w-full py-2 rounded hover:bg-green-700">
                        Create
                    </button>

                    <button type="button" id="closeClassModal"
                        class="bg-red-600 text-white w-full py-2 rounded hover:bg-red-700">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- =========================
     MODAL SCRIPT
========================= --}}
    <script>
        const openClassModal = document.getElementById("openClassModal");
        const closeClassModal = document.getElementById("closeClassModal");
        const classModal = document.getElementById("classModal");

        openClassModal.addEventListener("click", () => {
            classModal.classList.remove("hidden");
        });

        closeClassModal.addEventListener("click", () => {
            classModal.classList.add("hidden");
        });

        classModal.addEventListener("click", (e) => {
            if (e.target === classModal) {
                classModal.classList.add("hidden");
            }
        });
    </script>
@endsection
