@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="container">
    <h2>Notifications</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Message</th>
                <th>Read</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notifications as $notification)
                <tr>
                    <td>{{ $notification->id }}</td>
                    <td>{{ $notification->message }}</td>
                    <td>{{ $notification->is_read ? 'Yes' : 'No' }}</td>
                    <td>
                        <form action="{{ route('notifications.update', $notification->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary">Mark as Read</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
