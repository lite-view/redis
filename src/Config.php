<?php


namespace LiteView\Redis;


class Config
{
    public static $conf = null;

    public static function init()
    {
        if (!is_null(self::$conf)) {
            return;
        }
        if (function_exists('cfg')) {
            self::$conf['host'] = cfg('redis.host');
            self::$conf['port'] = cfg('redis.port');
            if (cfg('redis.prefix')) {
                self::$conf['prefix'] = cfg('redis.prefix');
            } elseif (cfg('app_name') && cfg('app_env')) {
                self::$conf['prefix'] = cfg('app_name') . ':' . cfg('app_env');
            }
        } elseif (defined("REDIS_CONNECTION")) {
            self::$conf['host'] = REDIS_CONNECTION['host'];
            self::$conf['port'] = REDIS_CONNECTION['port'];
            self::$conf['prefix'] = REDIS_CONNECTION['prefix'] ?? '';
        }
    }

    public static function set($host, $port, $prefix = null)
    {
        self::$conf['host'] = $host;
        self::$conf['port'] = $port;
        self::$conf['prefix'] = $prefix;
    }
}
