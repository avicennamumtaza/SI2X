<!-- resources/views/alternatives/edit.blade.php -->
@extends('layouts.sidebar')

@section('content')
<div class="container">
    <form action="{{ route('alternatives.update', $alternative) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $alternative->name }}" required>
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
                            <input type="number" step="0.01" class="form-control" name="scores[{{ $criteria->id }}]" value="{{ $alternative->criterias->find($criteria->id)->pivot->score ?? 0 }}" required>
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
