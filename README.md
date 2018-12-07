## 安装
- [Laravel](#laravel)
- [Lumen](#lumen)

### Laravel

该软件包可用于 Laravel 5.6 或更高版本。

您可以通过 composer 安装软件包：

``` bash
composer require starrysea/usually
```

在 Laravel 5.6 中，服务提供商将自动注册。在旧版本的框架中，只需在 config/app.php 文件中添加服务提供程序：

```php
'providers' => [
    // ...
    Starrysea\Usually\ConvertServiceProvider::class,
];

'aliases' => [
    // ...
    'Convert' => Starrysea\Usually\Convert::class,
];
```

### Lumen

您可以通过 composer 安装软件包：

``` bash
composer require starrysea/usually
```

注册服务提供者和门面：

```bash
$app->register(Starrysea\Usually\ConvertServiceProvider::class); // 注册 Convert 服务提供者

class_alias(Starrysea\Usually\Convert::class, 'Convert'); // 添加 Convert 门面
```

## 用法

```php
use Starrysea\Usually\Convert;

class ConvertGatherTest
{
    public static function collectNumerals()
    {
        $data = '你好, Laravel5.6';
        return Convert::collectNumerals($data); // 56
    }

    public static function filtercharacter()
    {
        $data = '你好, Laravel5.6';
        return Convert::filtercharacter($data); // 你好Laravel56
    }

    public static function hPhone()
    {
        $data = '13333336895';
        return Convert::hPhone($data); // 133****6895
//        return Convert::hPhone($data, '·'); // 133····6895
//        return Convert::hPhone($data, '·', '1'); // 1····336895
//        return Convert::hPhone($data, '·', 2, 6); // 13······895
    }

    public static function randstr()
    {
        return Convert::randstr(); // oIKNmM4Y
//        return Convert::randstr(3); // 2SV
//        return Convert::randstr(8, 's'); // 27723077
//        return Convert::randstr(8, 'x'); // aibiolgs
//        return Convert::randstr(8, 'd'); // JMDPYQNB
//        return Convert::randstr(8, 'sx'); // 3k1b0l2p
//        return Convert::randstr(8, 'sd'); // 2V3LTC5H
//        return Convert::randstr(8, 'xd'); // iGnyrQge
//        return Convert::randstr(8, 'sxd'); // ov1YRpns
    }
    
    public static function uniqueNumber()
    {
        return Convert::uniqueNumber(); // 111268305027050944060822644
//        return Convert::uniqueNumber('你好, laravel'); // 846243285156900266804426466422
    }

    public static function Pscws4()
    {
        $data = '我爱连衣裙';
        return Convert::Pscws4()->send_text($data)->set_ignore(true)->get_result('word'); // ['我爱', '连衣裙']
    }

    public static function isTerminal()
    {
        return Convert::isTerminal('pc'); // true
//        return Convert::isTerminal('phone'); // false
//        return Convert::isTerminal('android'); // false
//        return Convert::isTerminal('ios'); // false
//        return Convert::isTerminal('wechat'); // false
    }
}
```
