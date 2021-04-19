<?php


namespace app\core\exception;


class ForbiddenException extends \Exception
{
    /**
     * Attributes for ForbiddenException class.
     */
    protected $code = 403;
    protected $message = 'You dont have a permission to access this page';
}