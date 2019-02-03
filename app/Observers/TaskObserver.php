<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;
use App\Service\CodeGenerator;
use App\Service\GenerateCodeStrategy;

/**
 * Listeners for model Task.
 */
class TaskObserver
{
    /**
     * Handle the task "creating" event.
     *
     * @param  Task $task
     * @return void
     */
    public function creating(Task $task)
    {
        if (\Auth::user()) {
            $task->creator_id = \Auth::user()->id;
        } else {
            $task->creator_id = User::random()->id;
        }
        if (!$task->status) {
            $task->status = TaskStatus::default();
        }
    }

    /**
     * Handle the task "saved" event.
     *
     * @param  Task $task
     * @return void
     */
    public function saved(Task $task)
    {
        $codeGenerator = new CodeGenerator(new GenerateCodeStrategy);
        if (!$task->code) {
            $code = $codeGenerator->generate($task->theme, $task->getKey());
            $task->code = $code;
            $task->save();
        }
    }
}
