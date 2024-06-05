<!-- resources/views/criterias/index.blade.php -->
@extends('layouts.sidebar')

@section('content')
<div class="container">
    <a href="{{ route('criterias.create') }}" class="btn btn-primary">Add Criteria</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Weight</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($criterias as $criteria)
            <tr>
                <td>{{ $criteria->name }}</td>
                <td>{{ $criteria->weight }}</td>
                <td>
                    <a href="{{ route('criterias.edit', $criteria) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('criterias.destroy', $criteria) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection