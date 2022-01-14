<?php

namespace App\carrier;

use tgMdk\dto\CarrierReAuthorizeRequestDto;
use tgMdk\TGMDK_Transaction;

/*
 * キャリア決済 限度額確保要求サンプル
 * Created on 2020/07/10
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
 * サービスオプションタイプ
 *
 * docomo: ドコモケータイ払い
 */
$service_option_type = "docomo";

/**
 * 取引ID
 */
$order_id = "dummy" . time();

/**
 * 元取引ID
 * 対象とする過去の取引IDを指定
 */
$original_order_id = "";

/**
 * 与信方法(同時売上実施の有無)
 */
$is_with_capture = "false";

/**
 * 金額
 */
$amount = "10";

/**
 * 要求電文パラメータ値の指定
 */
$request_data = new CarrierReAuthorizeRequestDto();

$request_data->setServiceOptionType($service_option_type);
$request_data->setOrderId($order_id);
$request_data->setOriginalOrderId($original_order_id);
$request_data->setWithCapture($is_with_capture);
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
    echo "[Order ID]: " . $response_data->getOrderId() . "\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
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
