@extends('layouts.app')

@section('content')
<div class="lg:flex-1">
    @include('_profile-header', [
    'user' => $user
    ])
    @include('_timeline', [
    'tweets' => $user->tweets
    ])
</div>
@endsection

{{-- finished @ vid number 61 --}}
