<?php

namespace Tests\Unit\Models;

use App\Models\TaskType;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests TaskType model
 */
class TaskTypeTest extends TestCase
{
    /**
     * Test list method
     * @covers \App\Models\TaskType::list
     */
    public function testList()
    {
        $this->assertIsArray(TaskType::list());
    }

    /**
     * Test random method
     * @covers \App\Models\TaskType::random
     */
    public function testRandom()
    {
        $type = TaskType::random();
        $this->assertIsString($type);
        $this->assertNotEmpty($type);
    }

    /**
     * Test default method
     * @covers \App\Models\TaskType::default
     */
    public function testDefault()
    {
        $type = TaskType::default();
        $this->assertIsString($type);
        $this->assertNotEmpty($type);
    }
}
