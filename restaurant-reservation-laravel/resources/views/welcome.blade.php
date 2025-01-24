@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="jumbotron text-center">
    <h1>Welcome to Restaurant Reservations!</h1>
    <p>Book your table with ease and enjoy our delicious menu.</p>
    <a href="{{ route('reservations.index') }}" class="btn btn-primary">View Reservations</a>
</div>
@endsection
