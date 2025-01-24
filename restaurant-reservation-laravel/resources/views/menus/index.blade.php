@extends('layouts.app')

@section('title', 'Menus')

@section('content')
<div class="container">
    <h2>Menu Items</h2>
    <a href="{{ route('menus.create') }}" class="btn btn-success mb-3">Add Menu Item</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
                <tr>
                    <td>{{ $menu->id }}</td>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $menu->price }}</td>
                    <td>{{ $menu->category }}</td>
                    <td>
                        <a href="{{ route('menus.show', $menu->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline-block;">
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