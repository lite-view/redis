<?php


require __DIR__ . '/vendor/autoload.php';

// 配置方式一
const REDIS_CONNECTION = [
    'host' => '127.0.0.1',
    'port' => 6379,
    'prefix' => 'test:',
];


// 配置方式二
//\LiteView\Redis\Config::set('127.0.0.1', 6379, 'test:');


$r = \LiteView\Redis\RedisCli::select()->keys('*');
print_r($r);


$r = \LiteView\Redis\RedisCli::usePrefix()->keys('*');
print_r($r);
//

