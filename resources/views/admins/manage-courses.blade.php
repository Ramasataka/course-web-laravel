<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Managae Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
            @endif
        {{-- Students button --}}
        <button data-modal-target="crud-modal-courses" data-modal-toggle="crud-modal-courses" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
            Add Courses
        </button>

        <div id="crud-modal-courses" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Add New Courses
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal-courses">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" method="POST" action="{{ route('add-courses') }}" enctype="multipart/form-data">
                        @csrf
                    
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="nama_courses" class="block mt-1 w-full" type="text" name="nama_courses" :value="old('nama_courses')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('nama_courses')" class="mt-2" />
                        </div>
                    
                        <!-- deskripsi_courses Address -->
                        <div class="mt-4">
                            <x-input-label for="deskripsi_courses" :value="__('deskripsi_courses')" />
                            <textarea id="deskripsi_courses" class="block mt-1 w-full" type="text" name="deskripsi_courses" :value="old('deskripsi_courses')" ></textarea>
                            <x-input-error :messages="$errors->get('deskripsi_courses')" class="mt-2" />
                        </div>
                    
                        <!-- Mentor Dropdown -->
                        <div class="mt-4">
                            <x-input-label for="mentor_id" :value="__('Select Mentor')" />
                            <select id="mentor_id" name="mentor_id" class="block mt-1 w-full" required>
                                <option value="" disabled selected>Select a Mentor</option>
                                @foreach($mentors as $mentor)
                                    <option value="{{ $mentor->id }}">{{ $mentor->nama_user }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('mentor_id')" class="mt-2" />
                        </div>
                    
                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Image')" />
                            <input type="file" id="image" name="image" class="block mt-1 w-full" onchange="previewImage(event)">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                    
                        <div class="mt-4">
                            <img id="image-preview" src="#" alt="Image Preview" class="hidden w-32 h-32 object-cover rounded-lg border border-gray-300">
                        </div>
                    
                        <!-- Submit Button -->
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            Add new Courses
                        </button>
                    </form>
                </div>
            </div>
        </div> 
        </div>
    </div>

    <div class="container mx-auto py-4">
        <h1 class="text-2xl font-bold mb-4">Courses Management</h1>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border">No</th>
                    <th class="py-2 px-4 border">Nama Courses</th>
                    <th class="py-2 px-4 border">Deskripsi</th>
                    <th class="py-2 px-4 border">Gambar</th>
                    <th class="py-2 px-4 border">Mentor</th>
                    <th class="py-2 px-4 border">Created At</th>
                    <th class="py-2 px-4 border">Updated At</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4 border">{{ $loop->iteration + $courses->firstItem() - 1 }}</td>
                        <td class="py-2 px-4 border">{{ $course->nama_courses }}</td>
                        <td class="py-2 px-4 border">
                            <!-- Short Description with Conditional Modal Trigger -->
                                <span>{{ Str::limit($course->deskripsi_courses, 50) }}</span>
                                @if (Str::length($course->deskripsi_courses) > 50)
                                    <a href="#" class="text-blue-500 hover:underline" onclick="openModal({{ $loop->index }})">Read More</a>
                                @endif
                        </td>
                        <td class="py-2 px-4 border">
                            <img src="{{ asset('uploads/' . $course->gambar) }}" alt="Course img" class="w-16 h-16 object-cover rounded-full">
                        </td>
                        <td class="py-2 px-4 border">{{ $course->mentor->nama_user ?? 'No Mentor Assigned' }}</td>
                        <td class="py-2 px-4 border">{{ $course->created_at }}</td>
                        <td class="py-2 px-4 border">{{ $course->updated_at }}</td>
                        <td class="py-2 px-4 border">
                            <a href="/manage-courses/{{ $course->id }}/edit" class="text-blue-500 hover:underline">Edit</a>
                            <form action="" method="POST" onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </td>
                    </tr>
    
                    <!-- Hidden Full Description for Modal -->
                    <div class="hidden" id="full-desc-{{ $loop->index }}">
                        {{ $course->deskripsi_courses }}
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div id="descriptionModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden" onclick="closeModal(event)">
        <div class="bg-white w-full max-w-lg p-6 rounded shadow-lg" onclick="event.stopPropagation()">
            <h2 class="text-xl font-bold mb-4">Course Description</h2>
            <p id="modalContent" class="text-gray-700 overflow-y-auto max-h-80"></p>
            <div class="mt-4 flex justify-end">
                <button onclick="closeModal()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Close</button>
            </div>
        </div>
    </div>
    
    <!-- JavaScript for Modal Functionality -->
    <script>
        function openModal(index) {
            const descriptionModal = document.getElementById('descriptionModal');
            const modalContent = document.getElementById('modalContent');
            const fullDescription = document.getElementById(`full-desc-${index}`).innerText;
    
            modalContent.innerText = fullDescription;
            descriptionModal.classList.remove('hidden');
        }
    
        function closeModal(event) {
            const descriptionModal = document.getElementById('descriptionModal');
            if (event && event.target === descriptionModal) {
                descriptionModal.classList.add('hidden');
            } else if (!event) {
                descriptionModal.classList.add('hidden');
            }
        }
    </script>

    <div class="mt-4">
        {{ $courses->links() }}
    </div>


    
</x-app-layout>

