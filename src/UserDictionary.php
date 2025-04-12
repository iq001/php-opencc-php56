<?php

namespace Guang\PHPOpenCC;

class UserDictionary
{
    /**
     * 用户自定义词典
     *
     * @var array<string, string>
     */
    protected static $dictionary = [];

    /**
     * 添加一个转换规则到用户自定义词典
     *
     * @param string $from 源字符串
     * @param string $to 目标字符串
     * @return void
     */
    public static function add($from, $to)
    {
        self::$dictionary[$from] = $to;
    }

    /**
     * 批量添加转换规则到用户自定义词典
     *
     * @param array<string, string> $rules 转换规则数组
     * @return void
     */
    public static function addMany(array $rules)
    {
        self::$dictionary = array_merge(self::$dictionary, $rules);
    }

    /**
     * 清空用户自定义词典
     *
     * @return void
     */
    public static function clear()
    {
        self::$dictionary = [];
    }

    /**
     * 获取用户自定义词典
     *
     * @return array<string, string>
     */
    public static function get()
    {
        return self::$dictionary;
    }

    /**
     * 检查用户自定义词典是否为空
     *
     * @return bool
     */
    public static function isEmpty()
    {
        return empty(self::$dictionary);
    }
} 