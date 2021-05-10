<x-app>
    <div class="lg:flex-1 px-40">
        <form action={{route('profile/update', $user->username)}} method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-6">
                <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">Name</label>
                <input type="text" name="name" id="name" value={{$user->name}} required
                    class="border border-gray-400 p-2 w-full">
                @error('name')
                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="username" class="block mb-2 uppercase font-bold text-xs text-gray-700">Username</label>
                <input type="text" name="username" id="username" value={{$user->username}} required
                    class="border border-gray-400 p-2 w-full">
                @error('username')
                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">Email</label>
                <input type="email" name="email" id="email" value={{$user->email}} required
                    class="border border-gray-400 p-2 w-full">
                @error('email')
                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="avatar" class="block mb-2 uppercase font-bold text-xs text-gray-700">Avatar</label>
                <input type="file" name="avatar" id="avatar" required class="border border-gray-400 p-2 w-full">
                @error('avatar')
                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="border border-gray-400 p-2 w-full">
                @error('password')
                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                @enderror
            </div>
            {{-- If we tell laravel that confirmation is required its important to name this input as 'password_confirmation' cuz thats what its going to look for --}}
            <div class="mb-6">
                <label for="password_confirmation" class="block mb-2 uppercase font-bold text-xs text-gray-700">Confirm
                    password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="border border-gray-400 p-2 w-full">
                @error('password_confirmation')
                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <button type="submit" class="bg-blue-500 rounded-full shadow p-2 text-white text-xs">Update profile
                </button>
            </div>

        </form>
    </div>
</x-app>
