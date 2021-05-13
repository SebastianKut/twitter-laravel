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
{{-- start from vid number 65 at 4.50min (avatar upload)
--}}
