<?php

declare(strict_types=1);

namespace RomanNumeralConvertion;

use PHPUnit\Framework\TestCase;

class RomanNumeralConvertionTestCase extends TestCase
{
    protected $faker;

    public function setUp()
    {
        $this->faker = \Faker\Factory::create();
        parent::setUp();
    }
}
