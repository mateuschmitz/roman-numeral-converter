<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use RomanNumeralConvertion\Utils;

final class UtilsTest extends \RomanNumeralConvertion\RomanNumeralConvertionTestCase
{
    public function testDecoupleValueException() : void
    {
        $this->expectException(\InvalidArgumentException::class);
        Utils::decoupleValue($this->faker->randomNumber(5));
    }

    public function testDecoupleValueReturnIsArray() : void
    {
        $this->assertTrue(is_array(Utils::decoupleValue($this->faker->randomNumber(1))));
        $this->assertTrue(is_array(Utils::decoupleValue($this->faker->randomNumber(2))));
        $this->assertTrue(is_array(Utils::decoupleValue($this->faker->randomNumber(3))));
    }

    public function testDecoupleValueReturnsEmptyArrayWhenReceiveNumberZero() : void
    {
        $this->assertEmpty(Utils::decoupleValue(0));
    }

    /**
     * @dataProvider providerTestDecoupleValueResults
     */
    public function testDecoupleValueResults(int $number, array $expected) : void
    {
        $decoupled = Utils::decoupleValue($number);

        $this->assertEquals($expected, $decoupled);
        $this->assertEquals($number, array_reduce($decoupled, function($sum, $digit) {
            $sum += $digit;
            return $sum;
        }, 0));
    }

    public function providerTestDecoupleValueResults() : array
    {
        return [
            [1, [1]],
            [10, [10]],
            [100, [100]],
            [1000, [1000]],
            [13, [10, 3]],
            [19, [10, 9]],
            [34, [30, 4]],
            [50, [50]],
            [138, [100, 30, 8]],
            [199, [100, 90, 9]],
            [350, [300, 50]],
            [476, [400, 70, 6]],
            [500, [500]],
            [982, [900, 80, 2]],
            [1234, [1000, 200, 30, 4]],
            [999, [900, 90, 9]],
            [1854, [1000, 800, 50, 4]],
            [3999, [3000, 900, 90, 9]],
            [2576, [2000, 500, 70, 6]]
        ];
    }

    public function testGetMultiplierResults() : void
    {
        $this->assertEquals(10, Utils::getMultiplier(1));
        $this->assertEquals(100, Utils::getMultiplier(2));
        $this->assertEquals(1000, Utils::getMultiplier(3));
        $this->assertEquals(10000, Utils::getMultiplier(4));
        $this->assertEquals(100000, Utils::getMultiplier(5));
    }
}
