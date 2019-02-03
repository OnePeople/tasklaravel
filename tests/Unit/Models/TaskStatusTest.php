<?php

namespace Tests\Unit\Models;

use App\Models\TaskStatus;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests TaskStatus model
 */
class TaskStatusTest extends TestCase
{
    /**
     * Test list method
     * @covers \App\Models\TaskStatus::list
     */
    public function testList()
    {
        $this->assertIsArray(TaskStatus::list());
    }

    /**
     * Test random method
     * @covers \App\Models\TaskStatus::random
     */
    public function testRandom()
    {
        $status = TaskStatus::random();
        $this->assertIsString($status);
        $this->assertNotEmpty($status);
    }

    /**
     * Test default method
     * @covers \App\Models\TaskStatus::default
     */
    public function testDefault()
    {
        $status = TaskStatus::default();
        $this->assertIsString($status);
        $this->assertNotEmpty($status);
    }
}
