@extends('layouts.app')

@section('content')
<div class="lg:flex-1">
    @include('_publish-tweet-panel')
    @include('_timeline')
</div>
@endsection
