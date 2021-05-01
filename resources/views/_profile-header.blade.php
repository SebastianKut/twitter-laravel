<div class="lg:mx-10 mb-6">
    <header class="mb-2 relative">
        <img class="rounded-lg" src="/images/twitter-header.jpg" alt="">
        <img src="{{$user->avatar}}" alt=""
            class="rounded-full mr-2 absolute transform -translate-x-1/2 translate-y-1/2" style="
            bottom: 0;
            left:50%;
            width: 13%;
            ">
    </header>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="font-bold text-2xl mb-0">{{$user->name}}</h2>
            <p class="text-sm">Joined {{$user->created_at->diffForHumans()}}</p>
        </div>
        <div class="flex">
            <a href="" class="rounded-full shadow p-2 text-black text-xs mr-3">Edit Profile</a>
            <form action="/profile/{{$user->name}}/follow" method="POST">
                @csrf
                <button type="submit" class="bg-blue-500 rounded-full shadow p-2 text-white text-xs">
                    {{auth()->user()->isFollowing($user) ? 'Unfollow Me' : 'Follow Me'}}
                </button>
        </div>
    </div>
    <p class="text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod sit, accusantium perferendis
        voluptatem cumque consequatur doloribus pariatur eius atque ducimus sapiente blanditiis velit non. Debitis ab
        expedita obcaecati doloribus illum?</p>
</div>
