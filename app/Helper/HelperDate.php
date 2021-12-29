<?php

namespace App\Helper;

use DateTime;

class HelperDate
{

    /**
     * Devuelve una fecha ordenada en el formato descrito
     *
     * @param string $date
     * @param string $delimiter
     * @param string $format
     * @return DateTime
     */
    public function reverseDate(string $date, string $thisDelimiter = "/", string $convertDelimiter = "-"): string
    {
        if ($date === "") {
            return new $date;
        }

        return implode($convertDelimiter, array_reverse(explode($thisDelimiter, $date)));
    }
}
