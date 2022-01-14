<?php

namespace App\amazonpay;

use tgMdk\dto\AmazonpayReAuthorizeRequestDto;
use tgMdk\TGMDK_Transaction;

/*
 * Amazon Pay 再与信要求サンプル
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
 * 元取引ID
 * 随時決済申込時の取引IDを設定
 */
$original_order_id = "";

/**
 * 決済金額
 */
$amount = "100";

/**
 * 売上フラグ
 */
$is_with_capture = "false";

/**
 * 注文説明
 */
$note_to_buyer = "テスト商品";

/**
 * 与信時プッシュ先URL
 */
$authorize_push_url = "https://example.com";

/**
 * 売上時プッシュ先URL
 */
$capture_push_url = "https://example.com";

/**
 * キャンセル時プッシュ先URL
 */
$cancel_push_url = "https://example.com";

/**
 * 要求電文パラメータ値の指定
 */
$request_data = new AmazonpayReAuthorizeRequestDto();

$request_data->setOrderId($order_id);
$request_data->setOriginalOrderId($original_order_id);
$request_data->setAmount($amount);
$request_data->setWithCapture($is_with_capture);
$request_data->setNoteToBuyer($note_to_buyer);
$request_data->setAuthorizePushUrl($authorize_push_url);
$request_data->setCapturePushUrl($capture_push_url);
$request_data->setCancelPushUrl($cancel_push_url);

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

