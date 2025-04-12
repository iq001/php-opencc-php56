<?php

use Guang\PHPOpenCC\OpenCC;

require __DIR__ . '/../vendor/autoload.php';

// 添加单个转换规则
OpenCC::addUserRule('控制台', '控制臺');

// 批量添加转换规则
OpenCC::addUserRules([
    '计算机' => '計算機',
    '软件' => '軟件',
    '硬件' => '硬件',
]);

// 使用SIMPLIFIED_TO_HONGKONG策略转换"控制台"
// 由于用户自定义词典中定义了"控制台" => "控制臺"的规则，
// 所以会优先使用用户自定义词典，得到"控制臺"而不是"控制枱"
$result = OpenCC::s2hk('控制台');
echo "控制台 -> " . $result . "\n"; // 输出：控制台 -> 控制臺

// 使用SIMPLIFIED_TO_HONGKONG策略转换"计算机"
// 由于用户自定义词典中定义了"计算机" => "計算機"的规则，
// 所以会优先使用用户自定义词典，得到"計算機"
$result = OpenCC::s2hk('计算机');
echo "计算机 -> " . $result . "\n"; // 输出：计算机 -> 計算機

// 清空用户自定义词典
OpenCC::clearUserDictionary();

// 再次使用SIMPLIFIED_TO_HONGKONG策略转换"控制台"
// 由于用户自定义词典已被清空，所以会使用默认词典，得到"控制枱"
$result = OpenCC::s2hk('控制台');
echo "控制台 -> " . $result . "\n"; // 输出：控制台 -> 控制枱 