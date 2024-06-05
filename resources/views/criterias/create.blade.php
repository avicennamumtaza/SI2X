<!-- resources/views/criterias/create.blade.php -->
@extends('layouts.sidebar')

@section('content')
<div class="container">
    <form action="{{ route('criterias.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" step="0.01" class="form-control" id="weight" name="weight" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
