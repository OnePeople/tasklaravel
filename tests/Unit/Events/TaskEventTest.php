<?php

namespace Tests\Unit\Events;

use App\Models\{Task, TaskStatus, TaskType, User};
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * Unit tests task event
 */
class TaskEventTest extends TestCase
{
    use WithFaker, DatabaseMigrations;

    /**
     * @var User
     */
    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class, 1)
            ->create()
            ->first();
    }

    /**
     * Test user creator if not user not Auth.
     */
    public function testTaskUserCreatorNotAuth()
    {
        $taskData = array(
            'theme' => $this->faker->text(5),
            'content' => $this->faker->text(60),
            'status' => TaskStatus::random(),
            'type' => TaskType::random(),
            'performer_id' => $this->user->id
        );
        $task = new Task($taskData);
        $task->save();
        $this->assertIsInt($task->creator_id);
    }

    /**
     * Test user creator if not user are Auth.
     */
    public function testTaskUserCreatorAreAuth()
    {
        $this->be($this->user);
        $taskData = array(
            'theme' => $this->faker->text(5),
            'content' => $this->faker->text(60),
            'status' => '', // without status
            'type' => TaskType::default(),
            'performer_id' => $this->user->id
        );

        $task = new Task($taskData);
        $task->save();
        $this->assertIsInt($task->creator_id);
    }

    /**
     * Test code generator.
     * @param string $theme
     * @param string $code
     * @dataProvider codeGeneratorDataProvider
     */
    public function testCodeGenerator($theme, $code)
    {
        $this->be($this->user);
        $task = new Task();
        $task->theme = $theme;
        $task->content = $this->faker->text(60);
        $task->type = TaskType::default();
        $task->performer_id = $this->user->id;
        $task->save();
        $this->assertEquals($task->code, $code.$task->id);
    }

    /**
     * DataProvider for code generator.
     */
    public function codeGeneratorDataProvider()
    {
        return array(
            array('Kiyv is capital of Ukraine', 'KICOU-'),
            array(' - .  DFGD RT jy', 'DRJ-'),
            array('87ngui', '8-'),
            array('..,.,,,..--', 'CODE-'),
            array('Докладчик планирует', 'DP-'),
        );
    }

}
