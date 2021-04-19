<?php


namespace app\core;


class Session
{
    /**
     * Constants for Session class.
     */
    protected const FLASH_KEY = 'flash_messages';

    /**
     * Session constructor.
     */
    public function __construct(){
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage){
            $flashMessage['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    /**
     * Methods for Session class.
     */

    /**
     * @param $key
     * @param $message
     */
    public function setFlash($key, $message){
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message,
        ];
    }


    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value){
        $_SESSION[$key] = $value;
    }


    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    /**
     * @param $key
     */
    public function remove($key){
        unset($_SESSION[$key]);
    }

    /**
     * Session destructor.
     */
    public function __destruct(){
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage){
            if($flashMessage['remove']){
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
}