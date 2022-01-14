<?php

namespace App\merpay;

use tgMdk\dto\MerpayAuthorizeRequestDto;
use tgMdk\TGMDK_Transaction;

/*
 * メルペイオンライン決済(決済申込)サンプル
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
 */
$order_id = "dummy" . time();

/**
 * サービスオプションタイプ
 */
$service_option_type = "online";

/**
 * 支払金額
 */
$payment_amount = "100";

/**
 * 課金種別
 */
$accounting_type = "0";
// $accounting_type = "1";

/**
 * 与信同時売上フラグ
 */
$is_with_capture = "false";
// $is_with_capture = "true";

/**
 * 店舗ID
 */
$category_id = "1234";


/**
 * 要求電文パラメータ値の指定
 */
$request_data = new MerpayAuthorizeRequestDto();

$request_data->setOrderId($order_id);
$request_data->setServiceOptionType($service_option_type);
$request_data->setAmount($payment_amount);
$request_data->setAccountingType($accounting_type);
$request_data->setWithCapture($is_with_capture);
$request_data->setCategoryId($category_id);

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
if (TXN_SUCCESS_CODE === $txn_status) {
    // 成功
    echo $txn_status . "\n";
    echo "Transaction Successfully Complete\n";
    echo "[Message]: " . $error_message . "\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "[Order ID]: " . $response_data->getOrderId() . "\n";
    echo "[Merpay Processing Id]: " . $response_data->getMerpayProcessingId() . "\n";

} else if (TXN_PENDING_CODE === $txn_status) {
    //ペンディング
    echo $txn_status . "\n";
    echo "Transaction Pending\n";
    echo "[Message]: " . $error_message . "\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "[Order ID]: " . $response_data->getOrderId() . "\n";
    echo "Check log file for more information\n";

} else if (TXN_FAILURE_CODE === $txn_status) {
    // 失敗
    echo $txn_status . "\n";
    echo "Transaction Failure\n";
    echo "[Message]: " . $error_message . "\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "[Order ID]: " . $response_data->getOrderId() . "\n";
    echo "Check log file for more information\n";
}
