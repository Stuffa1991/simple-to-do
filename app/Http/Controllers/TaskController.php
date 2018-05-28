<?php

namespace App\Http\Controllers;

use App\Exceptions\TaskServiceException;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class TaskController
 * @package App\Http\Controllers
 */
class TaskController extends Controller
{
    /**
     * @param TaskService $taskService
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(TaskService $taskService)
    {
        try {
            $tasks = $taskService->getTasks(Auth::user());
        } catch (TaskServiceException $ex) {
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ], 400);
        }

        return response()->json([
            'success' => true,
            'tasks' => $tasks
        ], 400);
    }

    /**
     * @param Request $request
     * @param TaskService $taskService
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request, TaskService $taskService)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {
            $task = $taskService->getTask(Auth::user(), $request->input('id'));
        } catch (TaskServiceException $ex) {
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ], 400);
        }

        return response()->json([
            'success' => true,
            'task' => $task
        ], 400);
    }

    /**
     * @param Request $request
     * @param TaskService $taskService
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request, TaskService $taskService)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255'
        ]);

        try {
            $taskService->createTask(Auth::user(), $request->input('name'), $request->input('description'));
        } catch (TaskServiceException $ex) {
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Task was successfully created.'
        ]);
    }

    /**
     * @param Request $request
     * @param TaskService $taskService
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, TaskService $taskService)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'id' => 'required|integer'
        ]);

        try {
            $taskService->editTask(Auth::user(), $request->input('id'), $request->input('name'),
                $request->input('description'));
        } catch (TaskServiceException $ex) {
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Task was successfully edited.'
        ]);
    }

    /**
     * @param Request $request
     * @param TaskService $taskService
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, TaskService $taskService)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {
            $taskService->deleteTask(Auth::user(), $request->input('id'));
        } catch (TaskServiceException $ex) {
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Task was successfully deleted.'
        ]);
    }

    public function deleteMany(Request $request, TaskService $taskService)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'int'
        ]);

        try {
            $taskService->deleteTasks(Auth::user(), $request->input('ids'));
        } catch (TaskServiceException $ex) {
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Tasks was successfully deleted.'
        ]);
    }
}
