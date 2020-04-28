<?php


namespace App\Exceptions;


use Presentation\Http\Enums\HttpCodes;
use Throwable;


class InvalidBodyException extends \Error implements Throwable
{

    /**
     * @var array
     */
    private array $messages;

    public function __construct($message = [])
    {
        $this->messages = $message;
        parent::__construct();
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
    }
}
