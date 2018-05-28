<?php

namespace App\Services;

use App\Interfaces\TaskServiceInterface;
use App\User;

class TaskService implements TaskServiceInterface
{
    public function __construct()
    {
        // TODO: Do Something
    }

    public function getTasks(User $user)
    {
        // TODO: Implement getTasks() method.
    }

    public function getTask(User $user, int $id)
    {
        // TODO: Implement getTask() method.
    }

    public function createTask(User $user, string $name, string $description)
    {
        // TODO: Implement saveTask() method.
    }

    public function editTask(User $user, int $id, string $name, string $description)
    {
        // TODO: Implement editTask() method.
    }

    public function deleteTask(User $user, int $id)
    {
        // TODO: Implement deleteTask() method.
    }

    public function deleteTasks(USer $user, array $ids)
    {
        // TODO: Implement deleteTasks() method.
    }
}
