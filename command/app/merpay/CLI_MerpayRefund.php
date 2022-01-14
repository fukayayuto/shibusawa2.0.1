<?php

namespace App\merpay;

use tgMdk\dto\MerpayRefundRequestDto;
use tgMdk\TGMDK_Transaction;

/*
 * メルペイオンライン決済(返金)サンプル
 *
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
 * 決済申込時に利用したものを設定してください
 */
$order_id = "";

/**
 * サービスオプションタイプ
 */
$service_option_type = "online";
// $service_option_type = "barcode";

/**
 * 返金金額
 * バーコード決済の場合は指定不可
 */
$amount = "100";

/**
 * 要求電文パラメータ値の指定
 */
$request_data = new MerpayRefundRequestDto();

$request_data->setOrderId($order_id);
$request_data->setServiceOptionType($service_option_type);
if ($service_option_type == "online") {
    $request_data->setAmount($amount);
}

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
    echo "[Message]: " . $error_message . "\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "[Order ID]: " . $response_data->getOrderId() . "\n";
    echo "[Merpay Processing Id]: " . $response_data->getMerpayProcessingId() . "\n";
    echo "[Balance]: " . $response_data->getBalance() . "\n";
    echo "[Inquiry Code]: " . $response_data->getInquiryCode() . "\n";
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
