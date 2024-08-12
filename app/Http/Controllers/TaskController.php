<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
    
        $tasks = Task::with('project')->get();

        return view('tasks.task', compact('tasks'));
    }
}
