<?php

namespace Starrysea\Usually;

class Convert
{
    /**
     * 获取字符串中的数字
     * @param string $data 字符串
     * @return int 数字
     */
    public static function collectNumerals(string $data) : int
    {
        preg_match_all('/\d+/', $data, $arr);
        return join('', $arr[0]);
    }

    /**
     * 过滤特殊字符与空格
     * @param string $data 字符串
     * @param string $replacement 过滤时替换的字符串, 默认空
     * @return string 过滤后的字符串
     */
    public static function filtercharacter(string $data, string $replacement = '')
    {
        $char = "# #。、！？：；﹑•＂…‘’“”〝〞∕¦‖—　〈〉﹞﹝「」‹›〖〗】【»«』『〕〔》《﹐¸﹕︰﹔！¡？¿﹖﹌﹏﹋＇´ˊˋ―﹫︳︴¯＿￣﹢﹦﹤‐­˜﹟﹩﹠﹪﹡﹨﹍﹉﹎﹊ˇ︵︶︷︸︹︿﹀︺︽︾ˉ﹁﹂﹃﹄︻︼（）";
        $pattern = ['/[[:punct:]]/i', '/[' . $char . ']/u', '/[ ]{2,}/'];
        $data = preg_replace($pattern, $replacement, $data);
        return $data;
    }

    /**
     * 隐藏手机号码,默认中间四位数
     * @param int $phone 手机号码
     * @param string $symbol 隐藏时使用的符号
     * @param int $start 开始隐藏的位数
     * @param int $length 隐藏位数
     * @return string 隐藏后的数据
     */
    public static function hPhone(int $phone, string $symbol = '*', int $start = 3, int $length = 4)
    {
        $count = $symbol;
        for ($i=0; $i<($length-1); $i++){
            $count = $count . $symbol;
        }
        return substr_replace($phone, $count, $start, $length);
    }

    /**
     * 生成随机字符串
     * @param int $length 长度
     * @param string $type 种类[S数字，X小写字母，D大写字母] 默认SXD, 支持大小写均可
     * @return string 随机字符串
     */
    public static function randstr(int $length = 8, string $type = 'SXD') {
        $chars = '';
        $type = strtoupper($type);
        if (strpos($type,'X') !== false) $chars .= 'abcdefghijklmnopqrstuvwxyz';
        if (strpos($type,'S') !== false) $chars .= '01234567899876543210';
        if (strpos($type,'D') !== false) $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $hash = '';
        $max  = strlen($chars) - 1;
        mt_srand((double) microtime() * 1000000);
        for($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
        return $hash;
    }

    /**
     * 生成唯一号码
     * @param string $prefix
     * @return string
     */
    public static function uniqueNumber(string $prefix = '')
    {
        return base_convert(uniqid($prefix, true), 16, 10);
    }

    /**
     * 配置分词系统
     * @param string $charset
     * @return PSCWS4
     */
    public static function Pscws4(string $charset = 'utf8')
    {
        $pscws = new PSCWS4($charset);
        $pscws->set_dict(__DIR__.'/../pscws4/etc/dict.xdb');
        $pscws->set_rule(__DIR__.'/../pscws4/etc/rules.ini');
        return $pscws;
    }

    /**
     * 判断终端类型
     * @param string $terminal wechat => 微信, ios => 苹果, android => 安卓, phone => 手机, pc => 电脑
     * @return bool
     */
    public static function isTerminal(string $terminal)
    {
        $terminal = strtoupper($terminal);
        $regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";
        $regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";
        $regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";
        $regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";
        $regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";
        $regex_match.=")/i";
        switch ($terminal){
            case 'WECHAT':
                return strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') !== false;
                break;
            case 'IOS':
                return strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strpos($_SERVER['HTTP_USER_AGENT'], 'iPad');
                break;
            case 'ANDROID':
                return strpos($_SERVER['HTTP_USER_AGENT'], 'Android') ? true : false;
                break;
            case 'PHONE':
                return isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']) or preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']));
                break;
            case 'PC':
                return strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT') ? true : false;
                break;
            default:
                return false;
                break;
        }
    }
}
