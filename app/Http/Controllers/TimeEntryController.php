<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeEntry;
use App\Models\Project;
use App\Models\Task;

class TimeEntryController extends Controller
{
    public function index()
    {
        $timeEntries = TimeEntry::with(['project', 'task'])->get();
        return view('time_entries.timeentry', compact('timeEntries'));
    }

    public function create()
    {

        $projects = Project::all();
        $tasks = Task::all();
        return view('time_entries.timeentry_create', compact('projects', 'tasks'));
        
    }

    public function getTasks($projectId)
    {
    $tasks = Task::where('project_id', $projectId)->pluck('name', 'id');
    return response()->json($tasks);
    }


    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'task_id' => 'required|exists:tasks,id',
            'hours' => 'required|integer',
            'date' => 'required|date',
            'description' => 'required|string',
        ]);

        TimeEntry::create($request->all());

        return redirect()->route('time_entries.timeentry');
    }
}
