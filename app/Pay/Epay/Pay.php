<?php
declare (strict_types=1);

namespace App\Pay\Epay;


use App\Entity\PayEntity;
use App\Pay\Epay\Utils\StringUtil;
use App\Pay\PayBase;
use App\Pay\PayInterface;
use App\Utils\HttpUtil;
use Core\Exception\JSONException;
use Core\Utils\Bridge;
/**
 * Class Pay
 * @package app\Pay\Alipay
 */
class Pay extends PayBase implements PayInterface
{

    /**
     * @return PayEntity
     * @throws JSONException
     */
    public function trade(): PayEntity
    {
        $site = Bridge::getConfig('site');
        $postData = [
            'pid' => $this->config['merchant_id'],
            'name' => "订单".$this->tradeNo,
            'sitename' => $site['title'],
            'money' => $this->amount,
            'type' => $this->code,
            'notify_url' => $this->callbackUrl,
            'return_url' => $this->returnUrl,
            'out_trade_no' => $this->tradeNo,
            'sign_type' => "MD5"
        ];
        $postData['sign'] = StringUtil::generateSignature($postData, $this->config['key']);
        $payEntity = new PayEntity();
        $payEntity->setType(self::TYPE_JUMP);
        $payEntity->setUrl($this->config['url']."?".http_build_query($postData));
        return $payEntity;
    }
}