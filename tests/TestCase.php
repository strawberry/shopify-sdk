<?php

namespace Strawberry\Shopify\Tests;

use Mockery;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

abstract class TestCase extends BaseTestCase
{
    use MockeryPHPUnitIntegration;

    protected $base;

    public function setUp(): void
    {
        parent::setUp();

        $dotenv = Dotenv::create(__DIR__ . '/../');
        $dotenv->load();

        $this->base = __DIR__ . '/';

        if (method_exists($this, 'setUpTestCase')) {
            $this->setUpTestCase();
        }
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
