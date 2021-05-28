<div class="flex p-4 {{$loop->last ? '' : 'border-b border-b-gray-400'}}">
    <div class="mr-2 flex-shrink-0">
        <a href="{{route('profile', $tweet->user->username)}}">
            <img src="{{$tweet->user->avatar}}" alt="" class="rounded-full mr-2" style="width: 40px;">
        </a>
    </div>
    <div>
        <a href="{{route('profile', $tweet->user->username)}}">
            <h5 class="font-bold">
                {{$tweet->user->name}}
            </h5>
        </a>
        <p class="text-sm mb-2">
            {{$tweet->body}}
        </p>
        @if ($tweet->image)
        <a href="{{$tweet->image}}">
            <img class="h-32 w-64 mb-2 object-cover p-1 rounded-md shadow-sm" src="{{$tweet->image}}" alt="">
        </a>
        @endif

        <x-like-buttons :tweet="$tweet" />

        <x-comments :tweet="$tweet" />

    </div>
</div>
