<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Unit tests User model
 */
class UserTest extends TestCase
{
    use WithFaker, DatabaseMigrations;

    /**
     * @var User
     */
    private $userCreator;


    public function setUp()
    {
        parent::setUp();
        $this->userCreator = factory(User::class, 1)->create()->first();
        $this->be($this->userCreator);

    }

    /**
     * Test rules method.
     * @covers \App\Models\User::rules
     * @return void
     */
    public function testRules()
    {
        $this->assertIsArray(User::rules(0));
    }

}
