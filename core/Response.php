<?php


namespace app\core;


class Response
{
    /**
     * Methods for Response class.
     */

    /**
     * @param int $code
     */
     public function setStatusCode(int $code){
         http_response_code($code);
     }

    /**
     * @param string $url
     */
     public function redirect(string $url){
         header('Location: '.$url);
     }
}