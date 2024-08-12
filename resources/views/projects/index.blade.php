@extends('layouts.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center my-4">
   
    <a href="{{ route('tasks.task') }}" class="btn btn-primary">Manage Tasks</a>
    <a href="{{ route('time_entries.timeentry') }}" class="btn btn-primary">Time Entry</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-light">
    <tr>
    <th colspan="3" class="text-center">Manage Projects</th>
    </tr>
    
        <tr>
            <th>SNo</th>
            <th>Project Name</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $project->name }}</td>
            <td>{{ $project->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection


