<?php

namespace Strawberry\Shopify\Tests;

use Mockery;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

abstract class TestCase extends BaseTestCase
{
    use MockeryPHPUnitIntegration;

    public function setUp(): void
    {
        parent::setUp();

        $dotenv = Dotenv::create(__DIR__ . '/../');
        $dotenv->load();
    }

    /**
     * Shortcut for mocking classes.
     */
    protected function mock(...$args)
    {
        return Mockery::mock(...$args);
    }

    /**
     * Shortcut for making class spies.
     */
    protected function spy(...$args)
    {
        return Mockery::spy(...$args);
    }
}
