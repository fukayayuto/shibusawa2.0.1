<?php

namespace App\mpi;

use tgMdk\dto\MpiAuthorizeRequestDto;
use tgMdk\TGMDK_Transaction;

/*
 * クレジットカード決済(本人認証) 認可要求サンプル
 * Created on 2010/02/22
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
 * オプションタイプ
 * 1. 本人認証サービスのみ : mpi-none
 * 2. 完全認証 : mpi-complete
 * 3. 通常認証(カード会社リスク負担) : mpi-company
 * 4. 通常認証(カード会社、加盟店リスク負担) : mpi-merchant
 *
 */
$service_option_type = "mpi-company";

/**
 * 取引ID
 */
$order_id = "dummy" . time();

/**
 * 決済金額
 */
$payment_amount = "10";

/**
 * トークン
 */
$token = "73b45f38-a0e6-484e-b6ff-623473347665";

///**
// * カード番号
// */
//$card_number = "4111-1111-1111-1111";

///**
// * カード有効期限
// */
//$card_expire = "12/20";

/**
 * HTTP User-Agent（消費者ブラウザ）
 * （実際はアプリケーションサーバから取得）
 */
$http_user_agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";

/**
 * HTTP Accept（消費者ブラウザ）
 * （実際はアプリケーションサーバから取得）
 */
$http_accept = "text/*;q=0.3, text/html;q=0.7";

/**
 * デバイスチャネル
 * 02:ブラウザベース
 */
$device_channel = "02";

/**
 * カード保有者名
 */
$cardholder_name = "cardholderName";

/**
 * 要求電文パラメータ値の設定
 */
$request_data = new MpiAuthorizeRequestDto();
$request_data->setServiceOptionType($service_option_type);
$request_data->setOrderId($order_id);
$request_data->setAmount($payment_amount);
$request_data->setToken($token);
//$request_data->setCardNumber($card_number);
//$request_data->setCardExpire($card_expire);
$request_data->setHttpUserAgent($http_user_agent);
$request_data->setHttpAccept($http_accept);
$request_data->setDeviceChannel($device_channel);
$request_data->setCardholderName($cardholder_name);

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
    echo "[MPI Transaction Type]: " . $response_data->getMpiTransactiontype() . "\n";
//ペンディング
} else if (TXN_PENDING_CODE === $txn_status) {
    echo $txn_status . "\n";
    echo "Transaction Pending\n";
    echo "[Message]: " . $error_message . "\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "[Order ID]: " . $response_data->getOrderId() . "\n";
    echo "[MPI Transaction Type]: " . $response_data->getMpiTransactiontype() . "\n";
    echo "Check log file for more information\n";
// 失敗
} else if (TXN_FAILURE_CODE === $txn_status) {
    echo $txn_status . "\n";
    echo "Transaction Failure\n";
    echo "[Message]: " . $error_message . "\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "[Order ID]: " . $response_data->getOrderId() . "\n";
    echo "[MPI Transaction Type]: " . $response_data->getMpiTransactiontype() . "\n";
    echo "Check log file for more information\n";
}

