<?php

namespace Tests\Unit\Models;

use App\Models\{Task, TaskStatus, TaskType, User};
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Unit tests Task model
 */
class TaskTest extends TestCase
{
    use WithFaker, DatabaseMigrations;

    /**
     * @var User
     */
    private $userCreator;

    /**
     * @var User
     */
    private $userPerformer;

    public function setUp()
    {
        parent::setUp();
        $this->userCreator = factory(User::class, 1)->create()->first();
        $this->userPerformer = factory(User::class, 1)->create()->first();
        $this->be($this->userCreator);

    }

    /**
     * Test rules method.
     * @covers \App\Models\Task::rules
     * @return void
     */
    public function testRules()
    {
        $this->assertIsArray(Task::rules());
    }

    /**
     * Test types method.
     * @covers \App\Models\Task::types
     * @return void
     */
    public function testTypes()
    {
        $task = new Task;
        $this->assertEquals($task->types(), TaskType::list());
    }

    /**
     * Test statuses method.
     * @covers \App\Models\Task::statuses
     * @return void
     */
    public function testStatuses()
    {
        $task = new Task;
        $this->assertEquals($task->statuses(), TaskStatus::list());
    }

    /**
     * Test creator method.
     * @covers \App\Models\Task::creator
     * @return void
     */
    public function testCreator()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $task->creator_id = $user->id;
        $task->save();
        $this->assertEquals($task->creator->id, $user->id);
    }

    /**
     * Test performer method.
     * @covers \App\Models\Task::performer
     * @return void
     */
    public function testPerformer()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $task->performer_id = $user->id;
        $task->save();
        $this->assertEquals($task->performer->id, $user->id);
    }
}
