<!-- resources/views/alternatives/index.blade.php -->
@extends('layouts.sidebar')

@section('content')
<div class="container">
    <a href="{{ route('alternatives.create') }}" class="btn btn-primary">Add Alternative</a>
    <a href="{{ route('alternatives.calculateScores') }}" class="btn btn-success">Calculate Scores</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alternatives as $alternative)
            <tr>
                <td>{{ $alternative->name }}</td>
                <td>
                    <a href="{{ route('alternatives.edit', $alternative) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('alternatives.destroy', $alternative) }}" method="POST" class="d-inline">
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
