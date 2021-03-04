<?php
declare (strict_types=1);

return [
    'name' => '易支付聚合支付',
    'site' => 'https://www.ifking.cn',
    'desc' => '易支付',
    'list' => [
        cashier => '聚合支付',
    ],
    'callback' => [
        'isSign' => true,
        'status' => 'trade_status',
        'statusValue' => 'TRADE_SUCCESS',
        'isStatus' => true,
        'tradeNo' => 'out_trade_no',
        'amount' => 'money',
        'return' => 'success'
    ]
];