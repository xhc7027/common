<?php
namespace Jrcomposer\Common;

final class Noah
{

    private static $configs = [
        'url' => 'http://develop.commonapi.test.xin.com/gc/getGeneralConfigs'
    
    ];

    public function __construct()
    {
        ;
    }

    public function config($project, $item = [])
    {
        $parameters = [];
        $parameters['app_id'] = $project;
        $parameters['module_ids'] = [];
        $key = self::$configs['key'];
        $parameters['token'] = $this->createSign($parameters, $key);
        Request::post(self::$configs['url'],$parameters);
    }

    protected function createSign($parameters, $key)
    {
        ksort($parameters);
        $decipher = urldecode(http_build_query($parameters)) . $key;
        $cipher = md5($decipher);
        return $cipher;
    }
}

