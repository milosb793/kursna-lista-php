<?php


namespace KursnaLista\Utils;


use Exception;

class Util
{
    /**
     * @param $date
     * @return false|string
     * @throws \InvalidArgumentException
     */
    public static function parseDate($date)
    {
        if (empty($date)) {
            $date = 'now';
        }

        $new_date = date('d.m.Y', strtotime($date));

        if ($new_date === false) {
            throw new \InvalidArgumentException("Failed to parse date: {$date}");
        }

        return $new_date;
    }
}