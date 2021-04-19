<?php


namespace app\core\exception;


class NotFoundException extends \Exception
{
    /**
     * Attributes for NotFoundException class.
     */
    protected $message = 'Page not found';
    protected $code = 404;
}