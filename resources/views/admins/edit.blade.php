<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User ') . $user->nama_user }}
        </h2>
    </x-slot>

    <div class="py-12">
        <form class="max-w-md mx-auto" action="{{ route('update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="nama_user" id="nama_user" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="{{ old('nama_user', $user->nama_user) }}" required />
                <label for="nama_user" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama User</label>
            </div>
        
            <div class="relative z-0 w-full mb-5 group">
                <input type="email" name="email" id="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="{{ old('email', $user->email) }}" required />
                <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
            </div>
            
            <div class="relative z-0 w-full mb-5 group">
                <label for="image" class="block text-sm font-medium text-gray-700">Profile Image</label>
                <input type="file" name="image" id="image" class="block mt-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" accept="image/*" onchange="previewImage(event)" />
                
                <div class="mt-2">
                    @if ($user->image)  <!-- Display current image if exists -->
                        <img src="{{ asset('uploads/' . $user->image) }}" alt="Current Image" id="current-image" class="w-32 h-32 object-cover rounded" />
                    @endif
                    <!-- Image preview element -->
                    <img id="image-preview" alt="Image Preview" class="w-32 h-32 object-cover rounded hidden" />
                </div>
            </div>
        
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </div>
</x-app-layout>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('image-preview');
        const currentImage = document.getElementById('current-image');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result; // Set the image source to the file data
                imagePreview.classList.remove('hidden'); // Show the image preview
                currentImage.classList.add('hidden'); // Hide the current image
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = ''; // Clear the preview if no file is selected
            imagePreview.classList.add('hidden'); // Hide the image preview
            currentImage.classList.remove('hidden'); // Show the current image
        }
    }
</script>
