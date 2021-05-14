<x-app>
    <div class="flex flex-col flex-grow px-40">
        @foreach ( $users as $user )
        <a href="{{route('profile', $user->username)}}">
            <div class="flex items-center mb-5">
                <img class="mr-5" src="{{$user->avatar}}" alt="{{$user->username}}" width="50">
                <div>
                    <h4 class="font-bold"> {{$user->username}}</h4>
                </div>
            </div>
            @endforeach
        </a>
        {{$users->links()}}
    </div>
</x-app>
