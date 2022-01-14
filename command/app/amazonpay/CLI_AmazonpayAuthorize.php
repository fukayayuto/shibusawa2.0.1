<?php

namespace App\amazonpay;

use tgMdk\dto\AmazonpayAuthorizeRequestDto;
use tgMdk\TGMDK_Transaction;

/*
 * Amazon Pay 決済申込要求サンプル
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
 * 課金種別
 * 都度決済：0
 * 随時決済：1
 */
$accounting_type = "1";

/**
 * 承諾時決済タイプ
 * 承諾のみ：0
 * 与信＋承諾：1
 */
$consent_auth_type = "1";

/**
 * 決済金額
 */
$amount = "100";

/**
 * 売上フラグ
 */
$is_with_capture = "false";

/**
 * 配送先表示抑止フラグ
 */
$is_suppress_shipping_address_view = "false";

/**
 * 注文説明
 */
$note_to_buyer = "テスト商品";

/**
 * 完了時URL
 */
$success_url = "https://example.com";

/**
 * キャンセル時URL
 */
$cancel_url = "https://example.com";

/**
 * エラー時URL
 */
$error_url = "https://example.com";

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
 * 頻度（単位）
 */
$frequency_unit = "Week";

/**
 * 頻度（値）
 */
$frequency_value = "2";

/**
 * 配送先制限リスト
 */
$address_restrictions = "{\"type\":\"Allowed\",\"restrictions\":{\"JP\":{\"statesOrRegions\":[\"北海道\",\"青森県\"]}}}";

/**
 * 要求電文パラメータ値の指定
 */
$request_data = new AmazonpayAuthorizeRequestDto();

$request_data->setOrderId($order_id);
$request_data->setAccountingType($accounting_type);
$request_data->setConsentAuthType($consent_auth_type);
$request_data->setAmount($amount);
$request_data->setWithCapture($is_with_capture);
$request_data->setSuppressShippingAddressView($is_suppress_shipping_address_view);
$request_data->setNoteToBuyer($note_to_buyer);
$request_data->setSuccessUrl($success_url);
$request_data->setCancelUrl($cancel_url);
$request_data->setErrorUrl($error_url);
$request_data->setAuthorizePushUrl($authorize_push_url);
$request_data->setCapturePushUrl($capture_push_url);
$request_data->setCancelPushUrl($cancel_push_url);
$request_data->setFrequencyUnit($frequency_unit);
$request_data->setFrequencyValue($frequency_value);
$request_data->setAddressRestrictions($address_restrictions);

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
    echo "[Response Contents]: " . $response_data->getResponseContents() . "\n";
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

