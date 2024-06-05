<!-- resources/views/criterias/edit.blade.php -->
@extends('layouts.sidebar')
@section('content')
<div class="container">
    <form action="{{ route('criterias.update', $criteria) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $criteria->name }}" required>
        </div>
        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" step="0.01" class="form-control" id="weight" name="weight" value="{{ $criteria->weight }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
