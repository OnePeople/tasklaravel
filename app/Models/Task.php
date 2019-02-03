<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the Task model class for table "tasks".
 *
 * @property int id
 * @property varchar code
 * @property varchar theme
 * @property text content
 * @property enum status
 * @property enum type
 * @property int creator_id
 * @property int performer_id
 * @property timestamp  created_at
 * @property timestamp  updated_at
 */
class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'theme', 'content', 'creator_id', 'performer_id', 'type', 'status',
    ];

    /**
     * Table for ORM.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * Get rules for validation.
     * @return array
     */
    public static function rules():array
    {
        return [
            'theme' => 'required|min:3|max:255',
            'content' => 'required|min:3|max:64000',
            'performer_id' => 'required|integer',
             'status' => 'required|string|in:' . implode(',', TaskStatus::list()),
            'type' => 'required|string|in:' . implode(',', TaskType::list()),

        ];
    }

    /**
     * Get all types of task.
     * @return array
     */
    public function types():array
    {
        return TaskType::list();
    }

    /**
     * Get all statuses for task.
     * @return array
     */
    public function statuses():array
    {
        return TaskStatus::list();
    }

    /**
     * Get the creator for the task.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id')->withDefault(
            [
            'id' => 0,
            'name' => 'unknown'
            ]
        );
        ;
    }

    /**
     * Get the performer for the task.
     */
    public function performer()
    {
        return $this->belongsTo(User::class, 'performer_id')->withDefault(
            [
            'id' => 0,
            'name' => 'unknown'
            ]
        );
        ;
    }
}
