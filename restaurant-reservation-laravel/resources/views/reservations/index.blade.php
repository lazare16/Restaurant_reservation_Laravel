@extends('layouts.app')

@section('title', 'Reservations')

@section('content')
<div class="container">
    <h2>Reservations</h2>
    <a href="{{ route('reservations.create') }}" class="btn btn-success mb-3">Add Reservation</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Table</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->table_number }}</td>
                    <td>{{ $reservation->reservation_date }}</td>
                    <td>{{ $reservation->reservation_time }}</td>
                    <td>{{ $reservation->status }}</td>
                    <td>
                        <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Cancel</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection