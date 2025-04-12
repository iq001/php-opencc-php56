<?php

namespace Guang\PHPOpenCC;


/**
 * @method static string s2t(string $input)
 * @method static string s2hk(string $input)
 * @method static string s2jp(string $input)
 * @method static string s2tw(string $input)
 * @method static string s2twp(string $input)
 * @method static string hk2t(string $input)
 * @method static string hk2s(string $input)
 * @method static string tw2s(string $input)
 * @method static string tw2t(string $input)
 * @method static string tw2sp(string $input)
 * @method static string t2hk(string $input)
 * @method static string t2s(string $input)
 * @method static string t2tw(string $input)
 * @method static string t2jp(string $input)
 * @method static string jp2t(string $input)
 * @method static string jp2s(string $input)
 * @method static string simplifiedToTraditional(string $input)
 * @method static string simplifiedToHongkong(string $input)
 * @method static string simplifiedToJapanese(string $input)
 * @method static string simplifiedToTaiwan(string $input)
 * @method static string simplifiedToTaiwan_with_phrase(string $input)
 * @method static string hongkongToTraditional(string $input)
 * @method static string hongkongToSimplified(string $input)
 * @method static string taiwanToSimplified(string $input)
 * @method static string taiwanToTraditional(string $input)
 * @method static string taiwanToSimplified_with_phrase(string $input)
 * @method static string traditionalToHongkong(string $input)
 * @method static string traditionalToSimplified(string $input)
 * @method static string traditionalToTaiwan(string $input)
 * @method static string traditionalToJapanese(string $input)
 * @method static string japaneseToTraditional(string $input)
 * @method static string japaneseToSimplified(string $input)
 */
class OpenCC
{
    public static function convert($input, $strategy = Strategy::SIMPLIFIED_TO_TRADITIONAL)
    {
        $converter = new Converter();

        return $converter->convert($input, Dictionary::get($strategy));
    }

    public static function __callStatic($name, $arguments)
    {
        // s2t() => Strategy::S2T => (), simplifiedToTraditional() -> Strategy::SIMPLIFIED_TO_TRADITIONAL
        $strategy = strtoupper(preg_replace_callback('/[A-Z]/', function ($matches) {
            return '_'.$matches[0];
        }, lcfirst($name)));

        if (! defined(Strategy::class.'::'.strtoupper($strategy))) {
            throw new \BadMethodCallException(sprintf('Method "%s" does not exist.', $strategy));
        }

        return static::convert($arguments[0], constant(Strategy::class.'::'.$strategy));
    }
    
    /**
     * 添加一个转换规则到用户自定义词典
     *
     * @param string $from 源字符串
     * @param string $to 目标字符串
     * @return void
     */
    public static function addUserRule($from, $to)
    {
        UserDictionary::add($from, $to);
    }
    
    /**
     * 批量添加转换规则到用户自定义词典
     *
     * @param array<string, string> $rules 转换规则数组
     * @return void
     */
    public static function addUserRules(array $rules)
    {
        UserDictionary::addMany($rules);
    }
    
    /**
     * 清空用户自定义词典
     *
     * @return void
     */
    public static function clearUserDictionary()
    {
        UserDictionary::clear();
    }
}