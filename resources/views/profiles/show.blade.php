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
{{-- start from vid number 64 at 9min (avatar upload)
    also check;
    *why form only shows first name
    * doesnt let me log in with admin@test (password in db isn't hashed for some reason--}}
