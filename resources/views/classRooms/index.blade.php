@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">

    {{-- =====================
        PAGE HEADER
    ===================== --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">🏫 Class Rooms</h1>

        <button id="openClassModal"
            class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
            + New Class
        </button>
    </div>

    {{-- =====================
        SUCCESS MESSAGE
    ===================== --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- =====================
        ERROR MESSAGE
    ===================== --}}
    @if($errors->any())
        <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
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
                    <th class="px-6 py-3 text-left font-semibold">Class Name</th>
                    <th class="px-6 py-3 text-left font-semibold">Status</th>
                    <th class="px-6 py-3 text-right font-semibold">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($classRooms as $classRoom)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium">
                            {{ $classRoom->name }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-sm
                                {{ $classRoom->status === 'active'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($classRoom->status) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-right space-x-3">
                            <form action="{{ route('classrooms.destroy', $classRoom) }}"
                                  method="POST" class="inline"
                                  onsubmit="return confirm('Delete this class?');">
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
                        <td colspan="3" class="text-center py-10 text-gray-400">
                            No classes found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4">
             {{ $classRooms->appends(request()->query())->links() }}
        </div>
    </div>
</div>



{{-- =========================
     MODAL : CREATE CLASS
========================= --}}
<div id="classModal"
    class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">

    <div class="bg-white p-6 rounded-xl shadow-xl w-[500px]">
        <h2 class="text-xl font-bold mb-5 text-center">Create Class</h2>

        <form method="POST" action="{{ route('classrooms.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="font-semibold">Class Name</label>
                <input type="text" name="name"
                    class="w-full p-2 border rounded focus:ring focus:ring-indigo-200"
                    required>
            </div>

            <div>
                <label class="font-semibold">Status</label>
                <select name="status"
                    class="w-full p-2 border rounded focus:ring focus:ring-indigo-200">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div>
                <label class="font-semibold">Description</label>
                <textarea name="description"
                    class="w-full p-2 border rounded focus:ring focus:ring-indigo-200"
                    rows="3"></textarea>
            </div>

            <div class="flex gap-4 pt-2">
                <button type="submit"
                    class="bg-green-600 text-white w-full py-2 rounded hover:bg-green-700">
                    Save
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
