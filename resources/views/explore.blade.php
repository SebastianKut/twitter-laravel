<x-app>
    <div class="lg:mx-10 mb-6 flex-grow">
        @foreach ( $users as $user )
        <a href="{{route('profile', $user->username)}}">
            <div class="flex items-center mb-5">
                <img class="mr-5" src="{{$user->avatar}}" alt="{{$user->username}}" width="50">
                <div>
                    <h4 class="font-bold">{{$user->name}} <span
                            class="text-xs font-thin">{{'@' . $user->username}}</span></h4>

                </div>
            </div>
            @endforeach
        </a>
        {{$users->links()}}
    </div>
</x-app>
