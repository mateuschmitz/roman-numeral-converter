<?php

/**
 * @author Mateus Schmitz <matteuschmitz@gmail.com>
 * @package RomanNumeralConvertion
 */

declare(strict_types = 1);

require('./vendor/autoload.php');

try {
    if ($argc <= 1) {
        throw new \InvalidArgumentException("There's no number to convert!");
    }

    $value = (int)$argv[1];

    $decoupledValues = \RomanNumeralConvertion\Utils::decoupleValue($value);
    $romanValues     = array_map(function ($value) {return \RomanNumeralConvertion\Mapper::mapToRoman($value);}, $decoupledValues);

    echo "\nInput: " . $value . "\n";
    echo "    Output Custom:  " . implode('', $romanValues) . "\n";
    echo "    Output Classic: " . \RomanNumeralConvertion\Mapper::mapToRomanClassicWay($value) . "\n";

    echo "\nMemory Usage: " . memory_get_peak_usage(true) . " Bytes\n\n";
} catch (\Exception $e) {
    echo "\nAn error occurred when running the application: " . $e->getMessage() . "\n\n";
}
