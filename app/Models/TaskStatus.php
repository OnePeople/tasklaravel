<?php

namespace App\Models;

/**
 * Enum values for statuses of task.
 */
class TaskStatus
{
    /**
     * Status of task.
     *
     * @var string
     */
    public static $open = 'open';

    /**
     * Status of task.
     *
     * @var string
     */

    public static $working = 'working';

    /**
     * Status of task.
     *
     * @var string
     */
    public static $closed = 'closed';

    /**
     * Get all statuses.
     * @return array
     */
    public static function list():array
    {
        return [self::$open => self::$open, self::$working => self::$working, self::$closed => self::$closed];
    }

    /**
     * Get one random status.
     * @return string
     */
    public static function random():string
    {
        $list = collect(self::list());

        return $list->random();
    }

    /**
     * Get one default status.
     * @return string
     */
    public static function default():string
    {
        return self::$open;
    }
}
