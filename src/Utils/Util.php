<?php


namespace KursnaLista\Utils;


use Exception;

class Util
{
    public static function parseDate($date)
    {
        if (empty($date)) {
            $date = 'now';
        }

        $new_date = date('d.m.Y', strtotime($date));

        if ($new_date === false) {
            throw new Exception("Invalid date: {$date}");
        }

        return $new_date;
    }
}