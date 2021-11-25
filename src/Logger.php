<?php

namespace Surest\CoreHyperfSdk;

/**
 * 日志处理
 * @package Surest\Logger
 *
 * @method info(string $key, array $messages);
 * @method error(string $key, array $messages);
 */
class Logger
{
    protected $level;
    protected $loggerFilePathKey = 'logger_file_path';
    protected $loggerOpen = false;
    protected $filePath;

    /**
     * 日志级别
     * User: surest
     * DateTime: 2021/11/25 3:54 下午
     * @param $key
     * @param array $messages
     */
    public function logger($key, $messages = [])
    {
        $open = Config::getConfig('loggerOpen');
        $division = Config::getConfig('logger_division', false);
        $this->loggerOpen = $open ?: false;
        $this->filePath = Config::getConfig($this->loggerFilePathKey);
        if(!$this->loggerOpen) return;
        if($division) {
            $this->filePath = sprintf("%s/%s", date("Y-m-d"), $this->filePath);
        }

        $message = date("Y-m-d H:i:s") . "[$key] : " . json_encode($messages);
        error_log($message, '3', $this->filePath);
    }

    public function __call($level, $arguments)
    {
        $this->level = $level;
        $this->logger($arguments[0], $arguments[1]);
    }
}