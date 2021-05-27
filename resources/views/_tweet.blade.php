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
            <img class="h-32 w-64 mb-2 object-cover p-1 rounded-md shadow-2xl" src="{{$tweet->image}}" alt="">
        </a>
        @endif

        <x-like-buttons :tweet="$tweet" />

        @forelse ( $tweet->comments as $comment )

        <p>{{$comment->body}} - {{$comment->user->name}}</p>

        @can('destroy', $comment)
        <form action="{{route('delete/comment', $comment->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 rounded-lg shadow p-1 text-white text-xs">Delete
                comment</button>
        </form>
        @endcan

        @empty
        <p>No comments yet</p>

        @endforelse

        <form action="{{route('make/comment', $tweet->id)}}" method="POST">
            @csrf
            <input name="body" required placeholder="Comment..." class="w-full"></textarea>
            <button type="submit" class="bg-blue-500 rounded-lg shadow p-1 text-white">Comment</button>
        </form>

    </div>
</div>
