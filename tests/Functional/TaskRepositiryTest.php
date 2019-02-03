<?php

namespace Tests\Functional;

use App\Models\{Task, TaskStatus, TaskType, User};
use App\Repositories\TaskRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Functional tests for TaskRepository
 */
class TaskRepositoryTest extends TestCase
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

    /**
     * @var array
     */
    private $taskData;

    /**
     * @var TaskRepository
     */
    private $taskRepository;

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
        $this->taskData = array(
            'theme' => $this->faker->text(5),
            'content' => $this->faker->text(60),
            'status' => TaskStatus::default(),
            'type' => TaskType::default(),
            'performer_id' => $this->userPerformer->id
        );
        $this->taskRepository = new TaskRepository();
    }

    /**
     * Test action create.
     */
    public function testCreate()
    {
        $model = $this->taskRepository->create($this->taskData);
        $this->assertInstanceOf(Task::class, $model);
        $this->assertEquals($this->taskData['theme'], $model->theme);
        $this->assertEquals($this->taskData['content'], $model->content);
        $this->assertEquals($this->taskData['status'], $model->status);
        $this->assertEquals($this->taskData['type'], $model->type);
        $this->assertEquals($this->taskData['performer_id'], $model->performer_id);
        $this->assertEquals($this->userCreator->id, $model->creator_id);
    }

    /**
     * Test action find.
     */
    public function testFind()
    {
        $task = factory(Task::class)->create();
        $found = $this->taskRepository->find($task->id);
        $this->assertInstanceOf(Task::class, $found);
        $this->assertEquals($task->theme, $found->theme);
        $this->assertEquals($task->content, $found->content);
        $this->assertEquals($task->status, $found->status);
        $this->assertEquals($task->type, $found->type);
        $this->assertEquals($task->performer->id, $found->performer_id);
        $this->assertEquals($this->userCreator->id, $found->creator_id);
    }

    /**
     * Test action update.
     */
    public function testUpdate()
    {
        $task = factory(Task::class)->create();
        $resultUpdated = $this->taskRepository->update($this->taskData, $task->id);
        $this->assertEquals(1, $resultUpdated);
        $taskUpdated = $this->taskRepository->find($task->id);
        $this->assertEquals($this->taskData['theme'], $taskUpdated->theme);
        $this->assertEquals($this->taskData['content'], $taskUpdated->content);
        $this->assertEquals($this->taskData['status'], $taskUpdated->status);
        $this->assertEquals($this->taskData['type'], $taskUpdated->type);
        $this->assertEquals($this->taskData['performer_id'], $taskUpdated->performer_id);
    }

    /**
     * Test action delete.
     */
    public function testDelete()
    {
        $task = factory(Task::class)->create();
        $taskRepo = $this->taskRepository->delete($task->id);
        $this->assertTrue($taskRepo);
    }

    /**
     * Test ReportByStatus.
     * @param int $cntOpen
     * @param int $cntClosed
     * @param int $cntWorking
     * @param array $need
     * @dataProvider reportByStatusDataProvider
     */
    public function testReportByStatus($cntOpen, $cntClosed, $cntWorking, $need)
    {
        factory(Task::class, $cntOpen)->states('open-status')->create();
        factory(Task::class, $cntClosed)->states('closed-status')->create();
        factory(Task::class, $cntWorking)->states('working-status')->create();
        $report = $this->taskRepository->reportByStatus();
        $this->assertEquals($report, $need);
    }

    /**
     * DataProvider for reportByStatus.
     */
    public function reportByStatusDataProvider()
    {
        return array(
            'cnt_none_zero' => array(1, 2, 3, ['open' => 1, 'closed' => 2, 'working' => 3]),
            'cnt_zero' => array(0, 0, 0, []),
        );
    }

    /**
     * Test ReportCount.
     * @param int $cnt
     * @param int $need
     * @dataProvider reportCountDataProvider
     */
    public function testReportCount($cnt, $need)
    {
        factory(Task::class, $cnt)->create();
        $report = $this->taskRepository->reportCount();
        $this->assertEquals($report, $need);
    }

    /**
     * DataProvider for reportCount.
     */
    public function reportCountDataProvider()
    {
        return array(
            'cnt_null_zero' => array(2, 2),
            'cnt_zero' => array(0, -1),
        );
    }

}
