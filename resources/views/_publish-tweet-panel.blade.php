<div class="border border-blue-400 rounded-lg mb-10 lg:mx-10 p-6">
    <form action="/tweets" method="POST" enctype="multipart/form-data">
        @csrf
        <textarea name="body" required placeholder="What's on your mind?" class="w-full h-36"></textarea>

        <hr class="my-4">

        <footer class="flex justify-between items-center">
            <div>
                <img src="{{auth()->user()->avatar}}" alt="" class="rounded-full" style="width: 50px;">
            </div>
            <div class="flex items-center">
                <label for="image" class="uppercase font-bold text-sm text-gray-700 cursor-pointer">Add
                    image <i class="fas fa-plus-circle"></i></label>
                <input type="file" accept=".png, .jpg, .jpeg" name="image" id="image"
                    class="border border-gray-400 p-2 w-full hidden">
            </div>
            <button type="submit" class="bg-blue-500 rounded-lg shadow p-1 text-white h-8">Send a
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
