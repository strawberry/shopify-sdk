<?php

namespace Strawberry\Shopify\Tests;

use Mockery;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

abstract class TestCase extends BaseTestCase
{
    use MockeryPHPUnitIntegration;

    protected $base;

    public function setUp(): void
    {
        parent::setUp();

        $this->base = __DIR__ . '/';

        $this->setUpTestCase();
    }

    public function setUpTestCase(): void
    {
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

    /**
     * Load data from a file.
     */
    protected function data(string $file): string
    {
        return file_get_contents($this->base . $file);
    }
}
