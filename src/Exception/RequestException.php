<?php
namespace Jrcomposer\Common;


final class RequestException extends \Exception 
{

    public function __construct($message){
        parent::__construct();
        sendmsg($msg);
    }
}

