@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container">
    <h2>Users</h2>
    <a href="{{ route('users.create') }}" class="btn btn-success mb-3">Add User</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection