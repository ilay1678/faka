<?php
declare (strict_types=1);

namespace App\Pay\Epay\Utils;

/**
 * Class StringUtil
 * @package App\Pay\Epay\Utils
 */
class StringUtil
{

    /**
     * 获取数据签名
     * @param array $data
     * @param string $appKey
     * @return string
     */
    public static function generateSignature(array $data, string $appKey): string
    {
        ksort($data); //重新排序$data数组
        reset($data); //内部指针指向数组中的第一个元素
        $sign = '';
        foreach ($data as $key => $val) {
            if ($key == "sign" || $key == "sign_type" || $val == "" || $key == "handle" || $key == "s") continue;
            if ($key != 'sign') {
                if ($sign != '') {
                    $sign .= "&";
                }
                $val = urldecode($val);
                $sign .= "$key=$val"; //拼接为url参数形式
            }
        }
        return md5($sign . $appKey);
    }
}