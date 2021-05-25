<div class="flex">
    <form action="{{route('like/tweet', $tweet->id)}}" method="POST">
        @csrf
        @if ($tweet->isLikedBy(auth()->user()))
        <div class="mr-4 text-xs text-blue-500">
            <button type="submit">
                <i class="fas fa-thumbs-up"></i>
                <span>{{$tweet->likes ?: '0'}}</span>
            </button>
        </div>
        @else
        <div class="mr-4 text-xs text-gray-500">
            <button type="submit">
                <i class="far fa-thumbs-up"></i>
                <span>{{$tweet->likes ?: '0'}}</span>
            </button>
        </div>
        @endif
    </form>

    <form action="{{route('dislike/tweet', $tweet->id)}}" method="POST">
        @csrf
        @method('DELETE')
        @if ($tweet->isDislikedBy(auth()->user()))
        <div class="mr-4 text-xs text-blue-500">
            <button type="submit">
                <i class="fas fa-thumbs-down"></i>
                <span>{{$tweet->dislikes ?: '0'}}</span>
            </button>
        </div>
        @else
        <div class="mr-4 text-xs text-gray-500">
            <button type="submit">
                <i class="far fa-thumbs-down"></i>
                <span>{{$tweet->dislikes ?: '0'}}</span>
            </button>
        </div>
        @endif

    </form>
</div>
