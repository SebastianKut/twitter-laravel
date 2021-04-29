@extends('layouts.app')

@section('content')
<header>
    {{$user->name}}
</header>
@include('_timeline', [
'tweets' => $user->tweets
])
@endsection

{{-- finished at 10 mins vid number 60 --}}
