<?php
namespace Jrcomposer\Common;

use GuzzleHttp\Client;

final class Alarm 
{

    public function __construct()
    {
        ;
    }

    private function createSign()
    {
        ;
    }

    public function send($subject, $conntent, $delevier='',$receivers = [], $view = '')
    {
      ;
    }
    
    public function mail(){
        ;
    }
    
    public function qywx(){
        ;
    }
    public static function test(){
      $str=  Client::request('get',"https://www.baidu.com/",['keywords'=>'erntoo']);
      var_dump($str);
    }
   
}

