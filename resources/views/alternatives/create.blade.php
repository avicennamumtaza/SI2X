<!-- resources/views/alternatives/create.blade.php -->
@extends('layouts.sidebar')

@section('content')
<div class="container">
    <form action="{{ route('alternatives.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="scores">Scores</label>
            <table class="table">
                <thead>
                    <tr>
                        @foreach($criterias as $criteria)
                        <th>{{ $criteria->name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($criterias as $criteria)
                        <td>
                            <input type="number" step="0.01" class="form-control" name="scores[{{ $criteria->id }}]" required>
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
