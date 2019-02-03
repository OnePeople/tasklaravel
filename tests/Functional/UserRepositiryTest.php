<?php

namespace Tests\Functional;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Functional tests for UserRepository
 */
class UserRepositoryTest extends TestCase
{

    use WithFaker, DatabaseMigrations;

    /**
     * @var array
     */
    private $userData;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function setUp()
    {
        parent::setUp();
        $this->userData = array(
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => $this->faker->password(6,9)
        );
        $this->userRepository = new UserRepository();
    }

    /**
     * Test action create.
     */
    public function testCreate()
    {
        $model = $this->userRepository->create($this->userData);
        $this->assertInstanceOf(User::class, $model);
        $this->assertEquals($this->userData['name'], $model->name);
        $this->assertEquals($this->userData['email'], $model->email);
    }

    /**
     * Test action find.
     */
    public function testFind()
    {
        $user = factory(User::class)->create();
        $found = $this->userRepository->find($user->id);
        $this->assertInstanceOf(User::class, $found);
        $this->assertEquals($user->name, $found->name);
        $this->assertEquals($user->email, $found->email);
    }

    /**
     * Test action update.
     */
    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $resultUpdated = $this->userRepository->update($this->userData, $user->id);
        $this->assertEquals(1, $resultUpdated);
        $taskUpdated = $this->userRepository->find($user->id);
        $this->assertEquals($this->userData['name'], $taskUpdated->name);
        $this->assertEquals($this->userData['email'], $taskUpdated->email);
    }

    /**
     * Test action delete.
     */
    public function testDelete()
    {
        $user = factory(User::class)->create();
        $userRepo = $this->userRepository->delete($user->id);
        $this->assertTrue($userRepo);
    }

}
