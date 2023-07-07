<?php

namespace LiteView\Redis;


use Redis;


class RedisCli
{
    private static $pool;

    /**
     * @param int $db 0-15
     * @return Redis
     */
    public static function select($db = 0): Redis
    {
        if (!isset(self::$pool[$db][0])) {
            Config::init();
            $redis = new Redis();
            $redis->connect(Config::$conf['host'], Config::$conf['port']);
            $redis->select($db);
            self::$pool[$db][0] = $redis;
        }
        return self::$pool[$db][0];
    }

    /**
     * @param int $db 0-15
     * @return Redis
     */
    public static function usePrefix($db = 0)
    {
        if (!isset(self::$pool[$db][1])) {
            Config::init();
            $redis = new Redis();
            $redis->connect(Config::$conf['host'], Config::$conf['port']);
            $redis->select($db);
            self::$pool[$db][1] = new Transfer($redis, Config::$conf['prefix']); // RedisPlus 会加上配置的前缀
        }
        return self::$pool[$db][1];
    }
}
