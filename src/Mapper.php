<?php

/**
 * @author Mateus Schmitz <matteuschmitz@gmail.com>
 * @package RomanNumeralConvertion
 */

declare(strict_types = 1);

namespace RomanNumeralConvertion;

class Mapper
{
    /**
     * This is the number limit that app can convert into Roman numeral
     */
    private const NUMBER_LIMIT = 4000;
    
    public const UNITS_MAP = [
        1 => 'I', 
        2 => 'II', 
        3 => 'III', 
        4 => 'IV', 
        5 => 'V', 
        6 => 'VI', 
        7 => 'VII', 
        8 => 'VIII', 
        9 => 'IX'
    ];

    public const TENS_MAP = [
        10 => 'X', 
        20 => 'XX', 
        30 => 'XXX', 
        40 => 'XL', 
        50 => 'L', 
        60 => 'LX', 
        70 => 'LXX', 
        80 => 'LXXX', 
        90 => 'XC'
    ];

    public const HUNDREDS_MAP = [
        100 => 'C', 
        200 => 'CC', 
        300 => 'CCC', 
        400 => 'CD', 
        500 => 'D', 
        600 => 'DC', 
        700 => 'DCC', 
        800 => 'DCCC', 
        900 => 'CM'
    ];

    public const THOUSANDS_MAP = [
        1000 => 'M', 
        2000 => 'MM', 
        3000 => 'MMM'
    ];

    /**
     * This method can map directly from the constants defined above. If the value is not available, 
     * method will return NULL. It can handle number from 1-9, the tens 10-90, hundreds 100-900 and thousands 1000-3000
     * 
     * @param  int    $value value to be mapped
     * @throws InvalidArgumentException when number is higher than NUMBER_LIMIT const
     * @return ?string       a string with the mapped number or NULL
     */
    public static function mapToRoman(int $value) : ?string
    {
        if ($value > self::NUMBER_LIMIT) {
            throw new \InvalidArgumentException("The 'value' limit to decouple is " . self::NUMBER_LIMIT);
        }

        $allValues = self::UNITS_MAP + self::TENS_MAP + self::HUNDREDS_MAP + self::THOUSANDS_MAP;
        return isset($allValues[$value]) ? $allValues[$value] : null;
    }

    /**
     * This method implements a 'classic' way to map a arabic number to a roman number. 
     * It can receive a complete number and return the correct mapping.
     * 
     * @param  int    $value value to be converted/mapped
     * @throws InvalidArgumentException when number is higher than NUMBER_LIMIT const
     * @return string        a string with a roman number representation
     */
    public static function mapToRomanClassicWay(int $value) : string
    {
        if ($value > self::NUMBER_LIMIT) {
            throw new \InvalidArgumentException("The 'value' limit to decouple is " . self::NUMBER_LIMIT);
        }

        $units     = array_values(self::UNITS_MAP);
        $tens      = array_values(self::TENS_MAP);
        $hundreds  = array_values(self::HUNDREDS_MAP);
        $thousands = array_values(self::THOUSANDS_MAP);

        array_unshift($units, "");
        array_unshift($tens, "");
        array_unshift($hundreds, "");
        array_unshift($thousands, "");

        return $thousands[($value % (1000 * 10) / 1000)] . 
            $hundreds[($value % (100 * 10) / 100)] . 
            $tens[($value % (10 * 10) / 10)] . 
            $units[($value % (1 * 10) / 1)];
    }
}
