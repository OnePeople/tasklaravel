<?php

namespace App\Repositories;

use App\Models\Task;

/**
 * Task Repository.
 */
class TaskRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model():string
    {
        return Task::class;
    }

    /**
     * Report count task by status.
     *
     * @return array
     */
    public function reportByStatus():array
    {
        return $this->model
            ->select('status', \DB::raw('count(*) as cnt'))
            ->groupBy('status')
            ->get()
            ->pluck('cnt', 'status')
            ->toArray();
    }

    /**
     * Report count all tasks.
     *
     * @return int
     */
    public function reportCount():int
    {
        $count = $this->model
            ->count();

        return $count?$count:-1;
    }
}
