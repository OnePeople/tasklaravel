<?php

namespace Tests\Functional;
use App\Models\{User,Task};
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Functional tests for seeding demo data
 */
class SeedingTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * Test seeding.
     * @covers \App\Observers\TaskObserver::creating
     */
    public function testSeeding()
    {
        $this->seed();
        $usercnt = User::count();
        $taskcnt = Task::count();
        $this->assertEquals( 10,$usercnt );
        $this->assertEquals(10, $taskcnt );
    }

}
