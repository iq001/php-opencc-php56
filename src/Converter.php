<?php

namespace Guang\PHPOpenCC;

use Guang\PHPOpenCC\Contracts\ConverterInterface;

class Converter implements ConverterInterface
{
    public function convert($string, $dictionaries)
    {
        foreach ($dictionaries as $dictionary) {
            // [['f1' => 't1'], ['f2' => 't2'], ...]
            if (!empty($dictionary) && is_array(reset($dictionary))) {
                $tmp = [];
                foreach ($dictionary as $dict) {
                    $tmp = array_merge($tmp, $dict);
                }
                $dictionary = $tmp;
            }

            uksort($dictionary, function ($a, $b) {
                $lenA = mb_strlen($a);
                $lenB = mb_strlen($b);
                if ($lenA == $lenB) {
                    return 0;
                }
                return ($lenA < $lenB) ? 1 : -1;
            });

            $string = strtr($string, $dictionary);
        }

        return $string;
    }
}