<?php


namespace KursnaLista\Utils;


use Throwable;

class KursnaListaException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}