<?php

namespace App\Interfaces;

use App\User;

interface TaskServiceInterface
{

    /**
     * @param User $user
     * @return mixed
     */
    public function getTasks(User $user);

    /**
     * @param User $user
     * @param int $id
     * @return mixed
     */
    public function getTask(User $user, int $id);

    /**
     * @param User $user
     * @param string $name
     * @param string $description
     * @return mixed
     */
    public function createTask(User $user, string $name, string $description);

    /**
     * @param User $user
     * @param int $id
     * @param string $name
     * @param string $description
     * @return mixed
     */
    public function editTask(User $user, int $id, string $name, string $description);
    
    /**
     * @param User $user
     * @param array $ids
     * @return mixed
     */
    public function deleteTasks(User $user, array $ids);
}
