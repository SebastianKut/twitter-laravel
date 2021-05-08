<div class="border border-gray-300 rounded-lg lg:mx-10 p-6">
    @forelse ( $tweets as $tweet )
    @include('_tweet')
    @empty
    <p>No tweets yet</p>
    @endforelse
</div>
