<?php


namespace LiteView\Redis;


class Transfer
{
    private $redis;
    private $prefix;

    public function __construct($redis, $prefix = null)
    {
        $this->redis = $redis;
        $this->prefix = $prefix ?? '';
    }

    public function __call($method, $args)
    {
        // method_exists($this, $afterMethod)
        // call_user_func_array([$this, $afterMethod], $rs);
        if (!empty($args)) {
            $args[0] = $this->prefix . $args[0];
        }
        return call_user_func_array([$this->redis, $method], $args);
    }
}
