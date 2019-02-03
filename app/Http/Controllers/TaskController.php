<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;

/**
 * CRUD operation via UI for Tasks.
 */
class TaskController extends Controller
{
    /**
     * @var Task
     */
    private $task;

    public function __construct(TaskRepository $task)
    {
        $this->task = $task;
    }

    /**
     * Display a listing of the resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index()
    {
         $report =[
             'total' => $this->task->reportCount(),
             'byStatus' => $this->task->reportByStatus()
         ];

         return view('tasks.index', ['tasks' => $this->task->all(), 'report' => $report]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name', 'id');
        $formParams = ['route' => 'task.store'];
        return view('tasks.edit', ['task' =>  new Task , 'users' => $users, 'formParams' => $formParams]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return view('tasks.show', ['task' => $this->task->find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $users = User::pluck('name', 'id');
        $formParams = ['route' => ['task.update', $id], 'method' => 'PATCH'];

        return view('tasks.edit', ['task' =>  $this->task->find($id), 'users' => $users, 'formParams' => $formParams]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request, Task::rules());
        $this->task->update($request->only($this->task->getModel()->getFillable()), $id);

        return redirect()->route('task.index')->with('success', trans('task.updated'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $request->merge(['status' => TaskStatus::default()]);
        $this->validate($request, Task::rules());
        $this->task->create($request->only($this->task->getModel()->getFillable()));

        return redirect()->route('task.index')->with('success', trans('task.created'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        $this->task->delete($id);

        return redirect()->route('task.index')->with('success', trans('task.deleted'));
    }
}
