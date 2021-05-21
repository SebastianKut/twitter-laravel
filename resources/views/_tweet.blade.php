<div class="flex p-4 {{$loop->last ? '' : 'border-b border-b-gray-400'}}">
    <div class="mr-2 flex-shrink-0">
        <a href="{{route('profile', $tweet->user->username)}}">
            <img src="{{$tweet->user->avatar}}" alt="" class="rounded-full mr-2" style="width: 40px;">
        </a>
    </div>
    <div>
        <a href="{{route('profile', $tweet->user->username)}}">
            <h5 class="font-bold mb-4">
                {{$tweet->user->name}}
            </h5>
        </a>

        <p class="text-sm">
            {{$tweet->body}}
        </p>
        <div class="flex">
            <div class="mr-4 text-xs {{$tweet->isLikedBy(auth()->user()) ? 'text-blue-500' : 'text-gray-500'}}">
                <i class="far fa-thumbs-up"></i>
                <span>{{$tweet->likes ?: '0'}}</span>
            </div>
            <div class="mr-4 text-xs {{$tweet->isDislikedBy(auth()->user()) ? 'text-blue-500' : 'text-gray-500'}}">
                <i class="far fa-thumbs-down"></i>
                <span>{{$tweet->dislikes ?: '0'}}</span>
            </div>
        </div>
    </div>
</div>
