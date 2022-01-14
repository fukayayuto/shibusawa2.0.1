<?php

namespace App\mpi;

use tgMdk\dto\MpiGetResultRequestDto;
use tgMdk\TGMDK_Transaction;

/*
 * クレジットカード決済(本人認証) 本人認証結果確認要求サンプル
 * Created on 2021/05/21
 *
 */

/**
 * ステータスコード
 */
define('TXN_FAILURE_CODE', 'failure');
define('TXN_SUCCESS_CODE', 'success');

require_once("../../vendor/autoload.php");
require_once("../LoggerDefine.php");

/**
 * 取引ID(対象取引IDを設定してください)
 */
$order_id = "";

/**
 * 要求電文パラメータ値の設定
 */
$request_data = new MpiGetResultRequestDto();
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
    echo "[Request Id]: " . $response_data->getRequestId() . "\n";
    echo "[Req Amount]: " . $response_data->getReqAmount() . "\n";
    echo "[Req Card Number]: " . $response_data->getReqCardNumber() . "\n";
    echo "[Mpi Mstatus]: " . $response_data->getMpiMstatus() . "\n";
    echo "[Mpi Vresult Code]: " . $response_data->getMpiVresultCode() . "\n";
    echo "[Card Mstatus]: " . $response_data->getCardMstatus() . "\n";
    echo "[Auth Code]: " . $response_data->getAuthCode() . "\n";
    echo "[Ddd Message Version]: " . $response_data->getDddMessageVersion() . "\n";
    echo "[Ddd Transaction Id]: " . $response_data->getDddTransactionId() . "\n";
    echo "[Ddd Ds Transaction Id]: " . $response_data->getDddDsTransactionId() . "\n";
    echo "[Ddd Server Transaction Id]: " . $response_data->getDddServerTransactionId() . "\n";
    echo "[Ddd Transaction Status]: " . $response_data->getDddTransactionStatus() . "\n";
    echo "[Ddd Cavv Algorithm]: " . $response_data->getDddCavvAlgorithm() . "\n";
    echo "[Ddd Cavv]: " . $response_data->getDddCavv() . "\n";
    echo "[Ddd Eci]: " . $response_data->getDddEci() . "\n";
// 失敗
} else if (TXN_FAILURE_CODE === $txn_status) {
    echo $txn_status . "\n";
    echo "Transaction Failure\n";
    echo "[Message]: " . $error_message . "\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "Check log file for more information\n";
}
