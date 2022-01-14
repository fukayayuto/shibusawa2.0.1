<?php

namespace App\paypay;

use tgMdk\dto\PayPayAuthorizeRequestDto;
use tgMdk\TGMDK_Transaction;

/*
 * PayPayオンライン決済(決済申込)サンプル
 * Created on 2020/05/18
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
 * 同時売上実施有無
 */
$is_with_capture = "true";

/**
 * 支払金額
 */
$payment_amount = "100";

/**
 * 商品番号
 */
$item_id = "123456";

/**
 * 決済完了時URL
 */
$success_url = "http://localhost/web/paypay/Result.php?result=SUCCESS";

/**
 * 決済キャンセル時URL
 */
$cancel_url = "http://localhost/web/paypay/Result.php?result=CANCEL";

/**
 * 決済エラー時URL
 */
$error_url = "http://localhost/web/paypay/Result.php?result=ERROR";


/**
 * 要求電文パラメータ値の指定
 */
$request_data = new PayPayAuthorizeRequestDto();

$request_data->setOrderId($order_id);
$request_data->setServiceOptionType($service_option_type);
$request_data->setWithCapture($is_with_capture);
$request_data->setAmount($payment_amount);
$request_data->setItemId($item_id);
$request_data->setSuccessUrl($success_url);
$request_data->setCancelUrl($cancel_url);
$request_data->setErrorUrl($error_url);

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
    echo "[Order ID]: " . $response_data->getOrderId() . "\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "[Response Contents]: " . $response_data->getResponseContents() . "\n";

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
