<?php

namespace Tests\Functional;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;
use Tests\CreatesApplication;

/**
 * Functional Tests for home page
 */
class HomePageTest extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    /**
     * Test index page
     */
    public function testIndexPage()
    {
        $this->visit('/')
            ->see(trans('task.home.header'))
            ->dontSee('Error');
    }
}
