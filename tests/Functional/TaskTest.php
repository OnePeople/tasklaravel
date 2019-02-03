<?php

namespace Tests\Functional;

use App\Models\{Task, TaskStatus, User};
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;
use Tests\CreatesApplication;

/**
 * Functional tests CRUD of Task via UI
 */
class TaskTest extends BaseTestCase
{

    use CreatesApplication, DatabaseMigrations;

    /**
     * @var User
     */
    public $userCreator;

    /**
     * @var User
     */
    public $userPerformer;

    /**
     * @var Task
     */
    public $testTask;

    public function setUp()
    {
        parent::setUp();
        $this->userCreator = factory(User::class, 1)
            ->create()
            ->first();
        $this->userPerformer = factory(User::class, 1)
            ->create()
            ->first();
        $this->be($this->userCreator);
    }

    /**
     * Test index action.
     * @covers \App\Http\Controllers\TaskController::index
     * @return void
     */
    public function testIndex()
    {
        $this->visit('/task')
            ->see(trans('task.index.header'))
            ->seeStatusCode(200);
    }

    /**
     * Test create and store action.
     * @covers \App\Http\Controllers\TaskController::create
     * @covers \App\Http\Controllers\TaskController::store
     * @return void
     */
    public function testCreating()
    {
        $task = factory(Task::class, 1)
            ->make()
            ->first();
        $this->visit(route('task.create'))
            ->see(trans('task.editcreate.header'))
            ->seeStatusCode(200)
            ->type('Kiyv is capital of Ukraine', 'theme')
            ->type($task->content, 'content')
            ->type($task->type, 'type')
            ->type($this->userPerformer->id, 'performer_id')
            ->press(trans('task.save'))
            ->seePageIs('/task')
            ->seeInElement('td', $task->name)
            ->seeInElement('td', $task->type)
            ->seeInElement('td', TaskStatus::default())
            ->seeInElement('td', $task->performer->name)
            ->see(trans('task.created'))
            ->see('KICOU-1')
            ->seeStatusCode(200);
    }

    /**
     * Test  create and validation action.
     * @covers \App\Http\Controllers\TaskController::create
     * @return void
     */
    public function testCreatingIncorrect()
    {
        $this->visit(route('task.create'))
            ->see(trans('task.editcreate.header'))
            ->seeStatusCode(200)
            ->press(trans('task.save'))
            ->see('The theme field is required.')
            ->see('The content field is required.')
            ->seeStatusCode(200);
    }

    /**
     * Test show action.
     * @covers \App\Http\Controllers\TaskController::show
     * @return void
     */
    public function testShowExisting()
    {
        $task = factory(Task::class, 1)
            ->create()
            ->first();
        $this->visit(route('task.show', $task->id))
            ->seeInElement('div', $task->theme)
            ->seeInElement('div', $task->content)
            ->seeInElement('div', $task->type)
            ->seeInElement('div', $task->status)
            ->seeStatusCode(200);
    }

    /**
     * Test show NotExisting Task model action.
     * @covers \App\Http\Controllers\TaskController::show
     * @return void
     */
    public function testShowNotExisting()
    {
        $this->get(route('task.show', -54564));
        $this->assertResponseStatus(404);
    }

    /**
     * Test edit and update action.
     * @covers \App\Http\Controllers\TaskController::edit
     * @covers \App\Http\Controllers\TaskController::update
     * @return void
     */
    public function testUpdate()
    {
        $task = factory(Task::class, 1)
            ->create()
            ->first();
        $taskNew = factory(Task::class, 1)
            ->make()
            ->first();
        $this->visit(route('task.edit', $task->id))
            ->see(trans('task.editcreate.header'))
            ->seeStatusCode(200)
            ->type($taskNew->theme, 'theme')
            ->type($taskNew->content, 'content')
            ->type($taskNew->type, 'type')
            ->type($taskNew->status, 'status')
            ->type($taskNew->performer->id, 'performer_id')
            ->press(trans('task.save'))
            ->seePageIs('/task')
            ->see(trans('task.updated'))
            ->visit(route('task.show', $task->id))
            ->seeInElement('div', $taskNew->theme)
            ->seeInElement('div', $taskNew->type)
            ->seeInElement('div', $taskNew->status)
            ->seeInElement('div', $taskNew->performer->name)
            ->seeStatusCode(200);
    }

    /**
     * Test delete action.
     * @covers \App\Http\Controllers\TaskController::destroy
     */
    public function testDelete()
    {
        $task = factory(Task::class, 1)
            ->create()
            ->first();
        $this->delete(route('task.destroy', $task->id))
            ->assertRedirectedToRoute('task.index')
            ->flushSession(trans('task.deleted'));
    }
}
