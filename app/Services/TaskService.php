<?php

namespace App\Services;

use App\Exceptions\TaskServiceException;
use App\Interfaces\TaskServiceInterface;
use App\Task;
use App\User;

class TaskService implements TaskServiceInterface
{
    public function __construct()
    {
        // TODO: Do Something
    }

    /**
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getTasks(User $user)
    {
        // Return all tasks for that user
        return $user->tasks()->get();
    }

    /**
     * @param User $user
     * @param int $id
     * @return $this|mixed
     * @throws TaskServiceException
     */
    public function getTask(User $user, int $id)
    {
        // Find first task with that id
        $task = $user->tasks()->where('id', $id)->first();
        // If no task was found throw an exception
        if (!$task) {
            throw new TaskServiceException('There is no such task with that id.');
        }
        return $task;
    }

    /**
     * @param User $user
     * @param string $name
     * @param string $description
     * @return bool|mixed
     */
    public function createTask(User $user, string $name, string $description)
    {
        // Create task with information
        $user->tasks()->create([
            'name' => $name,
            'description' => $description
        ]);
        return true;
    }

    /**
     * @param User $user
     * @param int $id
     * @param string $name
     * @param string $description
     * @return bool|mixed
     * @throws TaskServiceException
     */
    public function editTask(User $user, int $id, string $name, string $description)
    {
        // Find first task with that id
        $task = $user->tasks()->where('id', $id)->first();
        // If no task was found throw an exception
        if (!$task) {
            throw new TaskServiceException('There is no such task with that id.');
        }

        $task->name = $name;
        $task->description = $description;
        $task->save();
        return true;
    }

    /**
     * @param User $user
     * @param int $id
     * @return bool|mixed
     * @throws TaskServiceException
     */
    public function deleteTask(User $user, int $id)
    {
        // Find first task with that id
        $task = $user->tasks()->where('id', $id)->first();
        // If no task was found throw an exception
        if (!$task) {
            throw new TaskServiceException('There is no such task with that id.');
        }
        $task->delete();
        return true;
    }

    /**
     * @param User $user
     * @param array $ids
     * @return bool|mixed
     * @throws TaskServiceException
     */
    public function deleteTasks(User $user, array $ids)
    {
        // Delete all tasks with ids
        (new Task)->destroy($ids);
        return true;
    }
}
