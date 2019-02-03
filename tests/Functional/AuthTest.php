<?php

namespace Tests\Functional;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;
use Tests\CreatesApplication;

/**
 * Functional Tests for Auth case
 *
 */
class AuthTest extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    /**
     * @var User
     */
    public $userCreator;

    public function setUp()
    {
        parent::setUp();
        $this->userCreator = factory(User::class, 1);
    }

    /**
     * Test case registration
     */
    public function testRegistrationPage()
    {
        $userCreator = $this->userCreator
            ->make()
            ->first();
        $this->visit('/register')
            ->see('Register')
            ->dontSee('Error')
            ->type($userCreator->name, 'name')
            ->type($userCreator->email, 'email')
            ->type('secret', 'password')
            ->type('secret', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/task')
            ->seeStatusCode(200);
    }

    /**
     * Test case login
     */
    public function testLoginPage()
    {
        $userCreator = $this->userCreator
            ->create()
            ->first();
        $this->visit('/login')
            ->type($userCreator->email, 'email')
            ->type('secret', 'password')
            ->press('Login')
            ->seePageIs('/task')
            ->seeStatusCode(200);
    }

    /**
     * Test Redirect If Authenticated
     */
    public function testRedirectIfAuthenticated()
    {
        $userCreator = $this->userCreator
            ->create()
            ->first();
        $this->be($userCreator);
        $this->visit('/login')
            ->seePageIs('/task')
            ->seeStatusCode(200);
        $this->visit('/register')
            ->seePageIs('/task')
            ->seeStatusCode(200);
    }
}
