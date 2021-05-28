{{-- <div class="flex p-4 {{$loop->last ? '' : 'border-b border-b-gray-400'}}">
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
</div> --}}

@foreach ( $tweet->comments as $comment )
<div class="m-4">
    <div class="flex justify-start">
        <div class="flex-shrink-0">
            <a href="{{route('profile', $comment->user->username)}}">
                <img src="{{$comment->user->avatar}}" alt="" class="rounded-full mr-1" style="width: 20px;">
            </a>
        </div>
        <div>
            <a href="{{route('profile', $comment->user->username)}}">
                <h5 class="text-sm font-bold">
                    {{$comment->user->name}}
                </h5>
            </a>
        </div>
    </div>
    <div class="flex items-center">
        <p class="text-xs ml-6">
            {{$comment->body}}
        </p>
        @can('destroy', $comment)
        <form class="flex items-center" action="{{route('delete/comment', $comment->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-gray-500 text-xs ml-2">
                <i class="far fa-trash-alt"></i>
            </button>
        </form>
        @endcan
    </div>
</div>
@endforeach



<form class="mt-4 flex items-center" action="{{route('make/comment', $tweet->id)}}" method="POST">
    @csrf
    <textarea name="body" required placeholder="Comment..." class="w-64 border mr-2 text-xs"></textarea>
    <button type="submit" class="bg-white rounded-lg shadow p-1 text-gray-500 text-xs h-6">Reply</button>
</form>
