<?php 
namespace Jrcomposer\Common;

class Queue{
    public function push(){
        return "send";
    }
    public function pull(){
        return "pull";
    }
    public function consumer(){
        return "consumer";
    }
}