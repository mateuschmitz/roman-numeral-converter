<?php

/**
 * @author Mateus Schmitz <matteuschmitz@gmail.com>
 * @package Demo
 */

require('./vendor/autoload.php');

$demoValues = [10, 100, 1000, 22, 36, 50, 51, 55, 114, 500, 430, 509, 510, 1786, 1590, 3098, 3999];

foreach ($demoValues as $value) {

    $decoupledValues = \RomanNumeralConvertion\Utils::decoupleValue($value);
    $romanValues     = array_map(function ($value) {return \RomanNumeralConvertion\Mapper::mapToRoman($value);}, $decoupledValues);

    echo "Input: " . $value . "\n";
    echo "    Output Custom: " . implode('', $romanValues) . "\n";
    echo "    Output Classic: " . \RomanNumeralConvertion\Mapper::mapToRomanClassicWay($value) . "\n";
}

echo "\nMemory Usage: " . memory_get_peak_usage(true) . " Bytes";
