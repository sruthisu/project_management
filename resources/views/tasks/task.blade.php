@extends('layouts.layout')

@section('content')


<div class="d-flex justify-content-between align-items-center my-4">
    
    <a href="{{ route('projects.index') }}" class="btn btn-primary">Manage Projects</a>
    <a href="{{ route('time_entries.timeentry') }}" class="btn btn-primary">Time Entry</a>
</div>
<table class="table table-bordered table-striped">
    <thead class="table-light">
    <tr>
    <th colspan="4" class="text-center">Manage Tasks</th>
    </tr>
        <tr>
            <th>SNo</th>
            <th>Project Name</th>
            <th>Task Name</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $task->project->name }}</td>
            <td>{{ $task->name }}</td>
            <td>{{ $task->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
