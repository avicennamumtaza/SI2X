@extends('layouts.sidebar')

@section('content')
<div class="container">
    <h2>Calculation Results</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Alternative</th>
                <th>Score</th>
                <th>Ranking</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $key => $result)
            <tr>
                <td>{{ $result['alternative'] }}</td>
                <td>{{ $result['score'] }}</td>
                <td>{{ $key + 1 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
