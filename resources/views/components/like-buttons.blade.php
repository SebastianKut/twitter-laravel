<div class="flex">
    <form action="{{route('like/tweet', $tweet->id)}}" method="POST">
        @csrf
        <div class="mr-4 text-xs {{$tweet->isLikedBy(auth()->user()) ? 'text-blue-500' : 'text-gray-500'}}">
            <button type="submit">
                <i class="far fa-thumbs-up"></i>
                <span>{{$tweet->likes ?: '0'}}</span>
            </button>

        </div>
    </form>

    <form action="{{route('dislike/tweet', $tweet->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <div class="mr-4 text-xs {{$tweet->isDislikedBy(auth()->user()) ? 'text-blue-500' : 'text-gray-500'}}">
            <button type="submit">
                <i class="far fa-thumbs-down"></i>
                <span>{{$tweet->dislikes ?: '0'}}</span>
            </button>

        </div>
    </form>
</div>
