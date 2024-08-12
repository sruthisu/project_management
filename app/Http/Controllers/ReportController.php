<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project; 

class ReportController extends Controller{

public function index()
    {
        $projects = Project::all();  // Fetch all projects for the dropdown
        return view('reports.report', compact('projects'));
    }


    public function search(Request $request)
{
    $projectId = $request->input('project_id');

    $reports = Project::with(['tasks', 'timeEntries'])
        ->where('id', $projectId)
        ->get()
        ->map(function ($project) {
            $project->total_hours = $project->timeEntries->sum('hours');
            $project->tasks = $project->tasks->map(function ($task) {
                $task->total_hours = $task->timeEntries->sum('hours');
                return $task;
            });
            return $project;
        });

    return response()->json($reports);
}

}
