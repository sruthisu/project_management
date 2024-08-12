@extends('layouts.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center my-4">

<a href="{{ route('time_entries.timeentry_create') }}" class="btn btn-primary mb-3 float-end">Add New Time Entry</a>

<a href="{{ route('reports.report') }}" class="btn btn-primary mb-3 float-end">Filter</a>
</div>
<table class="table table-bordered table-striped">
<thead class="table-light">
<tr>
    <th colspan="6" class="text-center">Time Entry</th>
    </tr>
        <tr>
            <th>SNo</th>
            <th>Project Name</th>
            <th>Task Name</th>
            <th>Hours</th>
            <th>Date</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach($timeEntries as $entry)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $entry->project->name }}</td>
                <td>{{ $entry->task->name }}</td>
                <td>{{ $entry->hours }}</td>
                <td>{{ $entry->date }}</td>
                <td>{{ $entry->description }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="position-fixed bottom-0 end-0 mb-3 me-3">
    <a href="{{ route('projects.index') }}" class="btn btn-primary">Manage Projects</a>
</div>
@endsection

<style>
    .position-fixed {
        position: fixed;
    }
    .bottom-0 {
        bottom: 0;
    }
    .end-0 {
        right: 0;
    }
    .mb-3 {
        margin-bottom: 1rem;
    }
    .me-3 {
        margin-right: 1rem;
    }
</style>