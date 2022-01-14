<?php

namespace App\amazonpay;

use tgMdk\dto\AmazonpayUpdateConsentRequestDto;
use tgMdk\TGMDK_Transaction;


/*
 * Amazon Pay 承諾情報更新要求サンプル
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
 * 随時決済申込時の取引IDを指定
 */
$order_id = "";

/**
 * 決済金額
 */
$amount = "100";

/**
 * 頻度（単位）
 */
$frequency_unit = "Year";

/**
 * 頻度（値）
 */
$frequency_value = "1";

/**
 * 注文説明
 */
$note_to_buyer = "テスト商品";


/**
 * 要求電文パラメータ値の指定
 */
$request_data = new AmazonpayUpdateConsentRequestDto();

$request_data->setOrderId($order_id);
$request_data->setAmount($amount);
$request_data->setFrequencyUnit($frequency_unit);
$request_data->setFrequencyValue($frequency_value);
$request_data->setNoteToBuyer($note_to_buyer);

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
    // 失敗
} else if (TXN_FAILURE_CODE === $txn_status) {
    echo $txn_status . "\n";
    echo "Transaction Failure\n";
    echo "[Message]: " . $error_message . "\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "[Order ID]: " . $response_data->getOrderId() . "\n";
    echo "Check log file for more information\n";
}