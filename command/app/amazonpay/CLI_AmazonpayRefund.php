<?php

namespace App\amazonpay;

use tgMdk\dto\AmazonpayRefundRequestDto;
use tgMdk\TGMDK_Transaction;

/*
 * Amazon Pay 返金要求サンプル
 */

/**
 * ステータスコード
 */
define('TXN_FAILURE_CODE', 'failure');
define('TXN_PENDING_CODE', 'pending');
define('TXN_SUCCESS_CODE', 'success');

require_once("../../vendor/autoload.php");
require_once("../LoggerDefine.php");

/**
 * 取引ID
 * 売上時の取引IDを指定
 */
$order_id = "";

/**
 * 返金金額
 */
$amount = "10";

/**
 * 要求電文パラメータ値の指定
 */
$request_data = new AmazonpayRefundRequestDto();

$request_data->setOrderId($order_id);
$request_data->setAmount($amount);

/**
 * 実施
 */
$transaction = new TGMDK_Transaction();
$response_data = $transaction->execute($request_data);

/**
 * 結果コード取得
 */
$txn_status = $response_data->getMStatus();
/**
 * 詳細コード取得
 */
$txn_result_code = $response_data->getVResultCode();
/**
 * エラーメッセージ取得
 */
$error_message = $response_data->getMerrMsg();

/**
 * 結果表示
 */
// 成功
if (TXN_SUCCESS_CODE === $txn_status) {
    echo $txn_status . "\n";
    echo "Transaction Successfully Complete\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "[Order ID]: " . $response_data->getOrderId() . "\n";
    echo "[Center Response Datetime]: " . $response_data->getCenterResponseDatetime() . "\n";
    echo "[Center Order Id]: " . $response_data->getCenterOrderId() . "\n";
    echo "[Center Transaction Id]: " . $response_data->getCenterTransactionId() . "\n";
    echo "[Refundable Amount]: " . $response_data->getRefundableAmount() . "\n";
    //ペンディング
} else if (TXN_PENDING_CODE === $txn_status) {
    echo $txn_status . "\n";
    echo "Transaction Pending\n";
    echo "[Message]: " . $error_message . "\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "[Order ID]: " . $response_data->getOrderId() . "\n";
    echo "Check log file for more information\n";
    // 失敗
} else if (TXN_FAILURE_CODE === $txn_status) {
    echo $txn_status . "\n";
    echo "Transaction Failure\n";
    echo "[Message]: " . $error_message . "\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "[Order ID]: " . $response_data->getOrderId() . "\n";
    echo "Check log file for more information\n";
}
