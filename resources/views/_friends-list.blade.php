<h3 class="font-bold text-xl mb-4">Following</h3>
<ul>
    @foreach (auth()->user()->idols as $idol )
    <li class="mb-2">
        <div class="flex items-center text-sm">
            <img src="{{$idol->avatar}}" alt="" class="rounded-full mr-2">
            {{$idol->name}}
        </div>
    </li>
    @endforeach

</ul>