<?php

/**
 * @author Mateus Schmitz <matteuschmitz@gmail.com>
 * @package RomanNumeralConvertion
 */

declare(strict_types = 1);

namespace RomanNumeralConvertion;

class Utils
{
    /**
     * This is the number limit that app can convert into Roman numeral
     */
    private const NUMBER_LIMIT = 4000;

    /**
     * Method used to decouple a value in units, tens, hundreds, and thousands. 
     * After that, returns an array with values.  If some value is 0 so, it will be removed 
     * from the return
     * 
     * @param  int    $value value to be decoupled
     * @throws InvalidArgumentException when number is higher than NUMBER_LIMIT const
     * @return array        an array with units, tens, hundreds, and thousands
     */
    public static function decoupleValue(int $value) : array
    {
        if ($value > self::NUMBER_LIMIT) {
            throw new \InvalidArgumentException("The 'value' limit to decouple is " . self::NUMBER_LIMIT);
        }

        $valueAsString = (string) $value;
        $numOfDigits   = strlen($valueAsString);
        $numbers       = [];

        for ($i = 0; $i < $numOfDigits; $i++) {
            $numbers[] = $valueAsString[$i] * self::getMultiplier($numOfDigits-$i-1);
        }

        $numbers = array_filter($numbers, function($number) {
            return $number > 0;
        });

        return $numbers;
    }

    /**
     * This method receives a number and returns a 1 followed by a sequence of 0 with 
     * the same length of the number received.
     * 
     * @param  int    $numOfZeros number of ZEROs needed
     * @return int             a number 1 (ONE) followed by 0 (ZEROS)
     */
    public static function getMultiplier(int $numOfZeros) : int
    {
        $multiplier = "1" . str_repeat("0", $numOfZeros);
        return (int) $multiplier;
    }
}
