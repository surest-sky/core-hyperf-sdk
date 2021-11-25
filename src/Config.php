<?php

namespace Surest\CoreHyperfSdk;

class Config
{
    static $config = [
        'logger_file_path' => '',
        'logger_division' => true,
        'version' => 'v1',
    ];

    /**
     * 获取配置项目
     * User: surest
     * DateTime: 2021/11/25 4:01 下午
     * @param $key
     */
    public static function getConfig($key, $default = '')
    {
        $value = isset(self::$config[$key]) ? self::$config[$key] : null;
        if($value) return $value;
        return $default;
    }

    /**
     * 配置设置
     * DateTime: 2021/11/25 4:04 下午
     * @param array $config
     */
    public static function loadConfig($config = [])
    {
        self::$config = $config;
    }
}