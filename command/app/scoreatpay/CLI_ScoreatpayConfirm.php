<?php

namespace App\scoreatpay;

use tgMdk\dto\ScoreatpayConfirmRequestDto;
use tgMdk\TGMDK_Transaction;

/*
 * スコア@払い 決済申込結果取得要求サンプル
 * Created on 2020/01/08
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
 * 決済申込結果取得対象取引IDを指定
 */
$order_id = "";

/**
 * 要求電文パラメータ値の指定
 */
$request_data = new ScoreatpayConfirmRequestDto();

$request_data->setOrderId($order_id);

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
    echo "[Nissen Transaction Id]:" . $response_data->getNissenTransactionId() . "\n";
    echo "[Authori Date]:" . $response_data->getAuthoriDate() . "\n";
    echo "[Author Result]:" . $response_data->getAuthorResult() . "\n";
    if (!is_null($response_data->getHoldReasons())) {
        foreach ($response_data->getHoldReasons() as $hold_reason) {
            echo "[Hold Reason Code]: " . $hold_reason->getReasonCode() . "\n";
            echo "[Hold Reason]: " . $hold_reason->getReason() . "\n";
        }
    }
//ペンディング
} else if (TXN_PENDING_CODE === $txn_status) {
    echo $txn_status . "\n";
    echo "Transaction Pending\n";
    echo "[Message]: " . $error_message . "\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "[Order ID]: " . $response_data->getOrderId() . "\n";
    echo "[Nissen Transaction Id]:" . $response_data->getNissenTransactionId() . "\n";
    echo "[Authori Date]:" . $response_data->getAuthoriDate() . "\n";
    echo "[Author Result]:" . $response_data->getAuthorResult() . "\n";
    if (!is_null($response_data->getErrors())) {
        foreach ($response_data->getErrors() as $error) {
            echo "[Error Code]: " . $error->getErrorCode() . "\n";
            echo "[Error Message]: " . $error->getErrorMessage() . "\n";
        }
    }
    echo "Check log file for more information\n";
// 失敗
} else if (TXN_FAILURE_CODE === $txn_status) {
    echo $txn_status . "\n";
    echo "Transaction Failure\n";
    echo "[Message]: " . $error_message . "\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "[Order ID]: " . $response_data->getOrderId() . "\n";
    echo "[Nissen Transaction Id]:" . $response_data->getNissenTransactionId() . "\n";
    echo "[Authori Date]:" . $response_data->getAuthoriDate() . "\n";
    echo "[Author Result]:" . $response_data->getAuthorResult() . "\n";
    echo "Check log file for more information\n";
}
