<x-app>
    <div class="lg:flex-1">
        @include('_profile-header', [
        'user' => $user
        ])
        @include('_timeline', [
        'tweets' => $user->tweets
        ])
    </div>
</x-app>
{{-- strat from vid number 64 at 3.23 --}}
