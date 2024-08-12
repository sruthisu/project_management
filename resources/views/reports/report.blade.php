@extends('layouts.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center my-4">

<a href="{{ route('time_entries.timeentry') }}" class="btn btn-primary mb-3 float-end">Time Entry</a>
<a href="{{ route('reports.report') }}" class="btn btn-primary mb-3 float-end">Filter</a>
</div>

<div class="mb-4">
    <label for="projectSelect">Search </label>
    <select id="projectSelect" class="form-control">
        <option value="">Select a project</option>
        @foreach($projects as $project)
            <option value="{{ $project->id }}">{{ $project->name }}</option>
        @endforeach
    </select>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-light">
    
    <tr>
    <th colspan="4" class="text-center">Reports</th>   
    </tr>
        <tr>
            <th>Sno</th>
            <th>Name</th>
            <th>Total hours</th>
        </tr>
    </thead>
    <tbody id="reportResults">
        <!-- Filtered report results will be shown here -->
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('#projectSelect').change(function() {
        let projectId = $(this).val();

        if (projectId) {
            $.ajax({
                url: "{{ route('reports.search') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    project_id: projectId
                },
                success: function(response) {
                    let reportHtml = '';
                    let sno = 1;

                    response.forEach(function(project) {
                        reportHtml += `
                            <tr style="background-color: #f8f9fa;">
                                <td>${sno++}</td>
                                <td><strong>${project.name}</strong></td>
                                <td><strong>${project.total_hours}</strong></td>
                            </tr>
                        `;

                        project.tasks.forEach(function(task) {
                            reportHtml += `
                                <tr>
                                    <td></td>
                                    <td>&nbsp;&nbsp;&nbsp;${task.name}</td>
                                    <td>${task.total_hours}</td>
                                </tr>
                            `;
                        });
                    });

                    $('#reportResults').html(reportHtml);
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText); // Add error handling
                }
            });
        } else {
            $('#reportResults').html('');  // Clear the results if no project is selected
        }
    });
});

</script>
@endsection
