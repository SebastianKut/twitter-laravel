<x-app>
    <div class="lg:flex-1">
        @include('_profile-header', [
        'user' => $user
        ])
        @include('_timeline', [
        'tweets' => $user->tweets()->paginate(50),
        ])
    </div>
</x-app>
