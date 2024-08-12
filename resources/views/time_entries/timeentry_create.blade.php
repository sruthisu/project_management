@extends('layouts.layout')

@section('content')
<div class="d-flex justify-content-end align-items-center my-4">
    <a href="{{ route('time_entries.timeentry') }}" class="btn btn-primary">Time Entry</a>
</div>

<h2 class="my-4">Add Time Entry</h2>

<form action="{{ route('time_entries.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="project_id" class="form-label">Project:</label>
        <select name="project_id" id="project_id" class="form-select">
            @foreach($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="mb-3">
        <label for="task_id" class="form-label">Task:</label>
        <select name="task_id" id="task_id" class="form-select">
            <!-- This will be populated based on the selected project -->
        </select>
    </div>
    
    <div class="mb-3">
        <label for="hours" class="form-label">Hours:</label>
        <input type="number" name="hours" id="hours" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label for="date" class="form-label">Date:</label>
        <input type="date" name="date" id="date" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <input type="text" name="description" id="description" class="form-control" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Add</button>
</form>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#project_id').change(function() {
            var projectId = $(this).val();
            if (projectId) {
                $.ajax({
                    url: '/get-tasks/' + projectId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#task_id').empty();
                        $('#task_id').append('<option value="">Select Task</option>');
                        $.each(data, function(key, value) {
                            $('#task_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#task_id').empty();
                $('#task_id').append('<option value="">Select Project First</option>');
            }
        });
    });
</script>

<script>
    success: function(data) {
    // console.log(data); // Check this to ensure it’s in the correct format
    $('#task_id').empty();
    $('#task_id').append('<option value="">Select Task</option>');
    $.each(data, function(key, value) {
        $('#task_id').append('<option value="' + key + '">' + value + '</option>');
    });
}
</script>
@endsection
