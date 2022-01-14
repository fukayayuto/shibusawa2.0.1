<?php

namespace App\scoreatpay;

use tgMdk\dto\ScoreatpayCaptureRequestDto;
use tgMdk\TGMDK_Transaction;

/*
 * スコア@払い 発送情報登録要求サンプル
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
 * 発送情報登録対象取引IDを指定
 */
$order_id = "";

/**
 * 運送会社コード
 *
 * 佐川急便 : 11
 * ヤマト運輸・クロネコメール便 : 12
 * 日本通運 : 13
 * 西濃運輸 : 14
 * 郵便書留 : 15
 * 郵パック : 16
 * セイノースーパーエクスプレス : 17
 * 福山通運 : 18
 * 新潟運輸 : 20
 * 名鉄運輸 : 21
 * 信州名鉄運輸 : 23
 * トールエクスプレスジャパン : 26
 * エコ配 : 27
 * 翌朝10時郵便 : 28
 * トナミ運輸 : 29
 */
$pd_company_code = "12";

/**
 * 配送伝票
 */
$slip_no = "12345678";

/**
 * 配送先ID
 */
$delivery_id = "12345678";

/**
 * 要求電文パラメータ値の指定
 */
$request_data = new ScoreatpayCaptureRequestDto();

$request_data->setOrderId($order_id);
$request_data->setPdCompanyCode($pd_company_code);
$request_data->setSlipNo($slip_no);
$request_data->setDeliveryId($delivery_id);

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
    echo "[Nissen Transaction Id]:" . $response_data->getNissenTransactionId() . "\n";
    if (!is_null($response_data->getErrors())) {
        foreach ($response_data->getErrors() as $error) {
            echo "[Error Code]: " . $error->getErrorCode() . "\n";
            echo "[Error Message]: " . $error->getErrorMessage() . "\n";
        }
    }
    echo "Check log file for more information\n";
}
