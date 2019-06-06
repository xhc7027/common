<?php
namespace Jrcomposer\Common;

use Illuminate\Log\Logger as ILogger;
use GuzzleHttp\Stream\Stream;

class Logger extends CommonAbstract implements CommonInterface
{

    public function getConfig()
    {
        ;
    }

    public function getDriver()
    {
        ;
    }

    // 日志对象实例
    private static $logger;

    // 日志文件名
    private static $logFile;

    // 日志路径
    private static $logPath;

    /*
     * @param string $logFile 日志文件名，可自定义日志文件名，默认为normal
     * @param string $logDir 日志文件路径，默认为/normal/中
     * @return \Monolog\Logger
     */
    public static function getLogger($logFile = 'normal', $logDir = 'normal')
    {
        $logFile = $tempLogFile = trim($logFile);
        if ($logFile === '' || ! preg_match('/^[-\w\.]+$/i', $logFile)) {
            $logFile = 'normal';
        }
        
        self::$logPath = str_replace("//", "/", self::getLogPath() . "{$logDir}");
        $logFile = self::$logPath . "/{$logFile}.log";
        if (! file_exists(self::$logPath)) {
            @mkdir(self::$logPath, 0777, true);
        }
        if (! file_exists($logFile)) {
            @touch($logFile);
            @chmod($logFile, 0755);
        }
        if (self::$logger === null || self::$logFile !== $logFile) {
            self::$logFile = $logFile;
            self::$logger = new ILogger(config('common.server_name'));
            self::$logger->pushHandler(new Stream($logFile));
        }
        return self::$logger;
    }

    /*
     * @desc 设置log路径
     *
     */
    private static function getLogPath()
    {
        return config('common.site_log_dir');
    }
}

