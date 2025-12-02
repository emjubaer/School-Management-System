@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 px-6">

        {{-- Page Header --}}
        <div class="flex items-center justify-between mb-8 px-4 py-3 bg-indigo-600 rounded-xl shadow">
            <h2 class="text-3xl font-bold text-white">📘 Students</h2>

            {{-- NEW REGISTRATION BUTTON (MODAL OPEN) --}}
            <button id="openModal"
                class="inline-flex items-center px-4 py-2 bg-white text-indigo-700 font-semibold rounded-lg shadow hover:bg-indigo-100 transition">
                + New Registration
            </button>
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
                <input type="text" name="q"
                    placeholder="🔍 Search by name or registration number..."
                    class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-2">

                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                    Search
                </button>
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-50">
                    <tr>
                        <th class="px-6 py-3">Reg.No</th>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Class</th>
                        <th class="px-6 py-3">Photo</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">

                    @forelse($students as $student)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">{{ $student->reg_no }}</td>
                            <td class="px-6 py-4 font-medium">{{ $student->name }}</td>
                            <td class="px-6 py-4">{{ $student->reg_class ?? '-' }}</td>

                            <td class="px-6 py-4">
                                @if ($student->photo)
                                    <img src="{{ asset('storage/students/' . $student->photo) }}"
                                        class="w-14 h-14 rounded-lg object-cover shadow" alt="photo">
                                @else
                                    <div class="w-14 h-14 bg-gray-100 flex items-center justify-center rounded-lg text-xs text-gray-400">
                                        No Photo
                                    </div>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right space-x-3">
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
                            <td colspan="5" class="text-center py-10 text-gray-500">
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



    <!-- ============================
          MODAL REGISTRATION FORM
    ============================ -->
    <div id="modalOverlay"
        class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-[600px] max-h-[90vh] overflow-y-auto">
            <h2 class="text-2xl font-bold mb-5 text-center">Student Registration</h2>

            <form method="POST" action="{{ route('students.store') }}"
                enctype="multipart/form-data" id="studentForm" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="font-semibold">Student Name</label>
                        <input type="text" name="name" class="w-full p-2 border rounded" required>
                    </div>

                    <div>
                        <label class="font-semibold">Email</label>
                        <input type="email" name="email" class="w-full p-2 border rounded" required>
                    </div>

                    <div>
                        <label class="font-semibold">Class</label>
                        <input type="text" name="reg_class" class="w-full p-2 border rounded" required>
                    </div>

                    <div>
                        <label class="font-semibold">Age</label>
                        <input type="number" name="age" class="w-full p-2 border rounded" required>
                    </div>
                </div>

                <div>
                    <label class="font-semibold">Address</label>
                    <textarea name="address" class="w-full p-2 border rounded" rows="3"></textarea>
                </div>

                <div>
                    <label class="font-semibold">Phone Number</label>
                    <input type="text" name="phone" class="w-full p-2 border rounded" required>
                </div>

                <div>
                    <label class="font-semibold">Photo</label>
                    <input type="file" name="photo" class="w-full p-2 border rounded">
                </div>

                <div class="flex gap-4 mt-4">
                    <button type="submit"
                        class="bg-green-600 text-white w-full py-2 rounded hover:bg-green-700">
                        Submit
                    </button>

                    <button type="button" id="closeModalBtn"
                        class="bg-red-600 text-white w-full py-2 rounded hover:bg-red-700">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>




<<script>
    const openBtn = document.getElementById("openModal");
    const closeBtn = document.getElementById("closeModalBtn");
    const modal = document.getElementById("modalOverlay");

    // Open Modal
    openBtn.addEventListener("click", () => {
        modal.classList.remove("hidden");
    });

    // Close Modal
    closeBtn.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    // Click Outside to Close
    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.classList.add("hidden");
        }
    });

    /* -------------------------------
       FIXED ENTER KEY NAVIGATION
    --------------------------------*/
    const inputs = document.querySelectorAll(
        '#studentForm input, #studentForm textarea, #studentForm button[type="submit"]'
    );

    inputs.forEach((input, index) => {

        input.addEventListener("keydown", function (e) {

            if (e.key === "Enter") {
                e.preventDefault();  // prevent accidental submit

                // If this is the last input → submit form
                if (index === inputs.length - 1) {
                    if (confirm("Do you want to save?")) {
                        document.getElementById("studentForm").submit();
                    }
                    return;
                }

                // Move to next input
                inputs[index + 1].focus();
            }

        });

    });
</script>


@endsection

