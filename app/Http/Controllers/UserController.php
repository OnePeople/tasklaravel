<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

/**
 * CRUD operation via UI for Users.
 */
class UserController extends Controller
{
    /**
     * @var User
     */
    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index()
    {
         return view('users.index', ['users' => $this->user->all()]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formParams = ['route' => 'user.store'];
        return view('users.edit', ['user' =>  new User , 'formParams' => $formParams]);
    }

    /**
     * Display the specified resource.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return view('users.show', ['user' => $this->user->find($id)]);
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
        $formParams = ['route' => ['user.update', $id], 'method' => 'PATCH'];

        return view('users.edit', ['user' =>  $this->user->find($id), 'users' => $users, 'formParams' => $formParams]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(Request $request, int $id)
    {
        $id = (int)$id;
        $this->validate($request, User::rules($id));
        $request->merge(['password'=>bcrypt($request->get('password'))]);
        $this->user->update($request->only($this->user->getModel()->getFillable()), $id);

        return redirect()->route('user.index')->with('success', trans('user.updated'));
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
        $this->validate($request, User::rules(0));
        $request->merge(['password'=>bcrypt($request->get('password'))]);
        $this->user->create($request->only($this->user->getModel()->getFillable()));

        return redirect()->route('user.index')->with('success', trans('user.created'));
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
        $this->user->delete($id);

        return redirect()->route('user.index')->with('success', trans('user.deleted'));
    }
}
