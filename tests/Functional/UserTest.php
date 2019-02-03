<?php

namespace Tests\Functional;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;
use Tests\CreatesApplication;

/**
 * Functional tests CRUD of User via UI
 */
class UserTest extends BaseTestCase
{

    use CreatesApplication, DatabaseMigrations;

    /**
     * @var User
     */
    public $user;


    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class, 1)
            ->create()
            ->first();
        $this->be($this->user);
    }

    /**
     * Test index action.
     * @return void
     */
    public function testIndex()
    {
        $this->visit('/user')
            ->see(trans('user.index.header'))
            ->seeStatusCode(200);
    }

    /**
     * Test create and store action.
     * @return void
     */
    public function testCreating()
    {
        $userNew= factory(User::class, 1)
            ->make()
            ->first();
        $this->visit(route('user.create'))
            ->see(trans('user.editcreate.header'))
            ->seeStatusCode(200)
            ->type($userNew->name, 'name')
            ->type($userNew->email, 'email')
            ->type('111111', 'password')
            ->press(trans('user.save'))
            ->seePageIs('/user')
            ->seeStatusCode(200);
        $createdUser =  User::where('email', $userNew->email)->first();
        $this->assertInstanceOf(User::class, $createdUser);
        $this->assertTrue(\Hash::check('111111', $createdUser->password));
    }

    /**
     * Test create and validation action.
     */
    public function testCreatingIncorrect()
    {
        $this->visit(route('user.create'))
            ->see(trans('user.editcreate.header'))
            ->seeStatusCode(200)
            ->press(trans('user.save'))
            ->see('The email field is required.')
            ->see('The name field is required.')
            ->seeStatusCode(200);
    }

    /**
     * Test show action.
     */
    public function testShowExisting()
    {
        $user = factory(User::class, 1)
            ->create()
            ->first();
        $this->visit(route('user.show', $user->id))
            ->seeInElement('div', $user->name)
            ->seeInElement('div', $user->email)
            ->seeStatusCode(200);
    }

    /**
     * Test show NotExisting User model action.
     */
    public function testShowNotExisting()
    {
        $this->get(route('user.show', -54564));
        $this->assertResponseStatus(404);
    }

    /**
     * Test edit and update action.
     * @covers \App\Http\Controllers\UserController::edit
     * @covers \App\Http\Controllers\UserController::update
     * @return void
     */
    public function testUpdate()
    {
        $user = factory(User::class, 1)
            ->create()
            ->first();
        $userNew = factory(User::class, 1)
            ->make()
            ->first();
        $this->visit(route('user.edit', $user->id))
            ->see(trans('user.editcreate.header'))
            ->seeStatusCode(200)
            ->type($userNew->name, 'name')
            ->type($userNew->email, 'email')
            ->type('111111', 'password')
            ->press(trans('user.save'))
            ->seePageIs('/user')
            ->see(trans('user.updated'))
            ->visit(route('user.show', $user->id))
            ->seeInElement('div', $userNew->name)
            ->seeInElement('div', $userNew->email)
            ->seeStatusCode(200);
    }

    /**
     * Test delete action.
     */
    public function testDelete()
    {
        $task = factory(User::class, 1)
            ->create()
            ->first();
        $this->delete(route('user.destroy', $task->id))
            ->assertRedirectedToRoute('user.index')
            ->flushSession(trans('user.deleted'));
    }
}
