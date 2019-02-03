<?php

namespace App\Models;

/**
 * Enum values for types of task.
 */
class TaskType
{
    /**
     * Type of task.
     * @var string
     */
    public static $task = 'task';

    /**
     * Type of task.
     * @var string
     */
    public static $issue = 'issue';

    /**
     * Get all types.
     * @return array
     */
    public static function list():array
    {
        return [self::$task => self::$task, self::$issue => self::$issue];
    }

    /**
     * Get one random type.
     * @return string
     */
    public static function random():string
    {
        $list = collect(self::list());
        return $list->random();
    }

    /**
     * Get one default type.
     * @return string
     */
    public static function default():string
    {
        return self::$task;
    }
}
