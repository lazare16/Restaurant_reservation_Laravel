@extends('layouts.app')

@section('title', 'Reservation Form')

@section('content')
<div class="container">
    <h2>{{ isset($reservation) ? 'Edit Reservation' : 'Add Reservation' }}</h2>
    <form action="{{ isset($reservation) ? route('reservations.update', $reservation->id) : route('reservations.store') }}" method="POST">
        @csrf
        @if(isset($reservation))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ isset($reservation) && $reservation->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="table_number" class="form-label">Table Number</label>
            <input type="number" name="table_number" id="table_number" class="form-control" value="{{ isset($reservation) ? $reservation->table_number : '' }}">
        </div>
        <div class="mb-3">
            <label for="reservation_date" class="form-label">Reservation Date</label>
            <input type="date" name="reservation_date" id="reservation_date" class="form-control" value="{{ isset($reservation) ? $reservation->reservation_date : '' }}">
        </div>
        <div class="mb-3">
            <label for="reservation_time" class="form-label">Reservation Time</label>
            <input type="time" name="reservation_time" id="reservation_time" class="form-control" value="{{ isset($reservation) ? $reservation->reservation_time : '' }}">
        </div>
        <div class="mb-3">
            <label for="number_of_guests" class="form-label">Number of Guests</label>
            <input type="number" name="number_of_guests" id="number_of_guests" class="form-control" value="{{ isset($reservation) ? $reservation->number_of_guests : '' }}">
        </div>
        <div class="mb-3">
            <label for="special_request" class="form-label">Special Request</label>
            <textarea name="special_request" id="special_request" class="form-control">{{ isset($reservation) ? $reservation->special_request : '' }}</textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" {{ isset($reservation) && $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ isset($reservation) && $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="canceled" {{ isset($reservation) && $reservation->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
