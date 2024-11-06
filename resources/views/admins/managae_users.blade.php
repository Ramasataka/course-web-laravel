<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Managae User') }}
        </h2>
    </x-slot>

    @if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <div class="py-12 flex justify-between">
        <div>
            {{-- Students button --}}
            <button data-modal-target="crud-modal-student" data-modal-toggle="crud-modal-student" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                Add Students
              </button>
        </div>
        <div>
            {{-- Mentor button --}}
            <button data-modal-target="crud-modal-mentor" data-modal-toggle="crud-modal-mentor" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                Add Mentor
              </button>
        </div>
    </div>

    <!-- modal mentro -->
<div id="crud-modal-mentor" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add New Mentor
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal-mentor">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" method="POST" action="{{ route('add-mentor') }}" enctype="multipart/form-data">
                @csrf
            
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="nama_user" class="block mt-1 w-full" type="text" name="nama_user" :value="old('nama_user')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('nama_user')" class="mt-2" />
                </div>
            
                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            
                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                
                <!-- Image Upload -->
                <div class="mt-4">
                    <x-input-label for="image" :value="__('Image')" />
                    <input type="file" id="image" name="image" class="block mt-1 w-full"  onchange="previewImage(event)">
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <img id="image-preview" src="#" alt="Image Preview" class="hidden w-32 h-32 object-cover rounded-lg border border-gray-300">
                </div>

            
                <!-- Submit Button -->
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add new mentor
                </button>
            </form>
        </div>
    </div>
</div> 

{{-- Modal Students --}}
<div id="crud-modal-student" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add New Students
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal-student">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" method="POST" action="{{ route('add-student') }}" enctype="multipart/form-data">
                @csrf
            
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="nama_user" class="block mt-1 w-full" type="text" name="nama_user" :value="old('nama_user')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('nama_user')" class="mt-2" />
                </div>
            
                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            
                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="image" :value="__('Image')" />
                    <input type="file" id="image" name="image" class="block mt-1 w-full"  onchange="previewImage(event)">
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <img id="image-preview" src="#" alt="Image Preview" class="hidden w-32 h-32 object-cover rounded-lg border border-gray-300">
                </div>

            
                <!-- Submit Button -->
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add new Students
                </button>
            </form>
        </div>
    </div>
</div> 


<div class="container mx-auto py-4">
    <h1 class="text-2xl font-bold mb-4">User Management</h1>
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-4 border">No</th>
                <th class="py-2 px-4 border">Nama</th>
                <th class="py-2 px-4 border">Email</th>
                <th class="py-2 px-4 border">Role</th>
                <th class="py-2 px-4 border">Last Accessed</th>
                <th class="py-2 px-4 border">Image</th>
                <th class="py-2 px-4 border">Email Verified At</th>
                <th class="py-2 px-4 border">Created At</th>
                <th class="py-2 px-4 border">Updated At</th>
                <th class="py-2 px-4 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-2 px-4 border">{{ $loop->iteration + $users->firstItem() - 1 }}</td>
                <td class="py-2 px-4 border">{{ $user->nama_user }}</td>
                <td class="py-2 px-4 border">{{ $user->email }}</td>
                <td class="py-2 px-4 border">
                    @foreach($user->roles as $role)
                    <span class="inline-block bg-blue-100 text-blue-800 text-sm px-2 rounded-full">{{ $role->name }}</span>
                @endforeach
                </td>
                <td class="py-2 px-4 border">{{ $user->last_accesed }}</td>
                <td class="py-2 px-4 border">
                    <img src="{{ asset('uploads/' . $user->image) }}" alt="User Image" class="w-16 h-16 object-cover rounded-full">
                </td>
                <td class="py-2 px-4 border">{{ $user->email_verified_at ? $user->email_verified_at : "Null" }}</td>
                <td class="py-2 px-4 border">{{ $user->created_at }}</td>
                <td class="py-2 px-4 border">{{ $user->updated_at }}</td>
                <td class="py-2 px-4 border">
                    <a href="/manage_user/{{$user->id}}/edit" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('delete', $user->id) }}" method="POST" onsubmit="return confirmDelete();">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">
                            Delete
                        </button>
                    </form>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



<div class="mt-4">
    {{ $users->links() }}
</div>
</x-app-layout>
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this user? This action cannot be undone.');
    }
</script>