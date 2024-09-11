<?php

namespace App\Exceptions;

use Exception;

class RepositoryException extends Exception
{
    /**
     * Crée une nouvelle instance de RepositoryException.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  \Exception|null  $previous
     * @return void
     */
    public function __construct($message = "Erreur dans le repository.", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
