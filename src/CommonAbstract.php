<?php
namespace Jrcomposer\Common;

abstract class CommonAbstract
{

    protected static $config;

    protected static $exception;


    /**
     * 获取初始化参数
     * @param array $config noah.dabanma配置
     * 
     */
    public function __construct($config = [])
    {
        $default = parse_ini_file('config.ini'); //本地ini配置
        
        //lumen 配置
        if (function_exists('config')) {
            $local = config('jrcommposer_common');
            if (! empty(config('jrcommposer_common'))) {
                $default = array_merge($default, $local);
            }
        }
        
        self::$config = array_merge($default, $config);
    }
    
    public static function __callstatic($method, $segmengts)
    {
        return (new static())->$method(...$segmengts);
    }
    
    public function __call($method, $segmengts)
    {
        return $this->$method(...$segmengts);
    }
}
