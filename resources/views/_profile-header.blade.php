<div class="lg:mx-10 mb-6">
    <header class="mb-2 relative">
        @can('edit', $user)
        <a href={{route('profile/edit', auth()->user()->username)}}>
            <img class="rounded-lg w-full" src={{$user->background_img}} alt="">
            <img src={{$user->avatar}} alt=""
                class="rounded-full mr-2 absolute transform -translate-x-1/2 translate-y-1/2" style="
                bottom: 0;
                left:50%;
                width: 13%;
                ">
        </a>
        @else
        <a href={{$user->background_img}}>
            <img class="rounded-lg w-full" src={{$user->background_img}} alt="">
        </a>
        <a href={{$user->avatar}}>
            <img src={{$user->avatar}} alt=""
                class="rounded-full mr-2 absolute transform -translate-x-1/2 translate-y-1/2" style="
                bottom: 0;
                left:50%;
                width: 13%;
                ">
        </a>
        @endcan
    </header>
    <div class="flex justify-between items-center mb-6">
        <div style="max-width: 300px;">
            <h2 class="font-bold text-2xl mb-0">{{$user->name}}</h2>
            <p class="text-sm">Joined {{$user->created_at->diffForHumans()}}</p>
        </div>
        <div class="flex">

            {{-- We can use @can to make conditional rendering of the Edit Profile button because we applied edit authorisation policy in UserPolicy --}}
            @can('edit', $user)
            <a href={{route('profile/edit', auth()->user()->username)}}
                class="rounded-full shadow p-2 text-black text-xs mr-3">Edit Profile</a>
            @endcan

            @can('follow', $user)
            <form action="/profile/{{$user->username}}/follow" method="POST">
                @csrf
                @if (auth()->user()->isFollowing($user))
                <button type="submit" class="bg-blue-500 rounded-full shadow p-2 text-white text-xs w-20">
                    Unfollow
                </button>
                @else
                <button type="submit" class="bg-white-500 rounded-full shadow p-2 text-black text-xs w-20">
                    Follow
                </button>
                @endif

            </form>
            @endcan


        </div>
    </div>
    <p class="text-sm">{{$user->description}}</p>
</div>
