<div class="border border-blue-400 rounded-lg mb-10 lg:mx-10 p-6">
    <form action="/tweets" method="POST" enctype="multipart/form-data">
        @csrf
        <textarea name="body" required placeholder="What's on your mind?" class="w-full"></textarea>

        <hr class="my-4">

        <footer class="flex justify-between">
            <div>
                <img src="{{auth()->user()->avatar}}" alt="" class="rounded-full" style="width: 50px;">
            </div>
            <div class="mb-6">
                <label for="image" class="block mb-2 uppercase font-bold text-xs text-gray-700">Add image</label>
                <input type="file" name="image" id="image" class="border border-gray-400 p-2 w-full">
            </div>
            <button type="submit" class="bg-blue-500 rounded-lg shadow py-4 px-2 text-white">Send a
                Tweet</button>
        </footer>
    </form>
    @error('body')
    <p class="text-red-500 text-sm mt-5">{{$message}}</p>
    @enderror
    @error('image')
    <p class="text-red-500 text-xs mt-2">{{$message}}</p>
    @enderror
</div>
