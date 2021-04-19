<?php


namespace app\core;


abstract class UserModel extends DbModel
{
    /**
     * Methods for UserModel class.
     */

    /**
     * @return string
     */
    abstract public function getDisplayName(): string;
}