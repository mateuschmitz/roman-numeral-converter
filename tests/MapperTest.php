<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use RomanNumeralConvertion\Mapper;

final class MapperTest extends \RomanNumeralConvertion\RomanNumeralConvertionTestCase
{
    public function testMapRomanException() : void
    {
        $this->expectException(\InvalidArgumentException::class);
        Mapper::mapToRoman(4001);
    }

    public function testMapRomanReturnsEmptyArrayWhenReceiveNumberZero() : void
    {
        $this->assertEmpty(Mapper::mapToRoman(0));
    }

    public function testMapRomanClassicWayReturnsEmptyStringWhenReceiveNumberZero() : void
    {
        $this->assertEmpty(Mapper::mapToRomanClassicWay(0));
    }

    public function testMapRomanClassicWayException() : void
    {
        $this->expectException(\InvalidArgumentException::class);
        Mapper::mapToRomanClassicWay(4001);
    }

    public function testMapRomanUnits() : void
    {
        $digit = $this->faker->randomDigitNotNull();
        $this->assertEquals(Mapper::UNITS_MAP[$digit], Mapper::mapToRoman($digit));
    }

    public function testMapRomanTens() : void
    {
        $keys = array_keys(Mapper::TENS_MAP);
        $tenValue = $keys[array_rand($keys)];
        $this->assertEquals(Mapper::TENS_MAP[$tenValue], Mapper::mapToRoman($tenValue));
    }

    public function testMapRomanHundreds() : void
    {
        $keys = array_keys(Mapper::HUNDREDS_MAP);
        $hundredValue = $keys[array_rand($keys)];
        $this->assertEquals(Mapper::HUNDREDS_MAP[$hundredValue], Mapper::mapToRoman($hundredValue));
    }

    public function testMapRomanThousands() : void
    {
        $keys = array_keys(Mapper::THOUSANDS_MAP);
        $thousandValue = $keys[array_rand($keys)];
        $this->assertEquals(Mapper::THOUSANDS_MAP[$thousandValue], Mapper::mapToRoman($thousandValue));
    }

    /**
     * @dataProvider providerTestmapToRomanClassicWayReturn
     */
    public function testmapToRomanClassicWayReturn(int $number, string $expected) : void
    {
        $this->assertEquals(Mapper::mapToRomanClassicWay($number), $expected);
    }

    public function providerTestmapToRomanClassicWayReturn() : array
    {
        return [
            [1, 'I'],
            [3, 'III'],
            [5, 'V'],
            [9, 'IX'],
            [10, 'X'],
            [35, 'XXXV'],
            [99, 'XCIX'],
            [100, 'C'],
            [101, 'CI'],
            [547, 'DXLVII'],
            [876, 'DCCCLXXVI'],
            [1005, 'MV'],
            [1097, 'MXCVII'],
            [2361, 'MMCCCLXI'],
            [3999, 'MMMCMXCIX']
        ];
    }

    public function testCompareCustomMethodWithClassicMethod() : void
    {
        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->numberBetween(1, 4000);

            $decoupledValues = RomanNumeralConvertion\Utils::decoupleValue($number);
            $romanValues = array_map(function ($value) {return \RomanNumeralConvertion\Mapper::mapToRoman($value);}, $decoupledValues);

            $this->assertEquals(Mapper::mapToRomanClassicWay($number), implode('', $romanValues));
        }
    }

}






