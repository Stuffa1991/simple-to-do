<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(TaskService $taskService)
    {
        // TODO: Get all tasks and return them
    }

    public function view(TaskService $taskService, int $id)
    {
        // TODO: View single tasks and return it
    }

    public function create(TaskService $taskService, Request $request)
    {
        // TODO: Create task
    }

    public function edit(TaskService $taskService, Request $request)
    {
        // TODO: Edit task
    }

    public function delete(TaskService $taskService, Request $request)
    {
        // TODO: Delete task
    }
}
