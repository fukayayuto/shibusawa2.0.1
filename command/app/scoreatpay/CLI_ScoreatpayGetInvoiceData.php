<?php

namespace App\scoreatpay;

use tgMdk\dto\ScoreatpayGetInvoiceDataRequestDto;
use tgMdk\TGMDK_Transaction;

/*
 * スコア@払い 請求印字データ取得要求サンプル
 * Created on 2020/01/08
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
 * 取引ID
 * 請求印字データ取得対象取引IDを指定
 */
$order_id = "";

/**
 * 要求電文パラメータ値の指定
 */
$request_data = new ScoreatpayGetInvoiceDataRequestDto();

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
    echo "[Nissen Transaction Id]: " . $response_data->getNissenTransactionId() . "\n";
    echo "[Invoice Bar Code]: " . $response_data->getInvoiceBarCode() . "\n";
    echo "[Invoice Code]: " . $response_data->getInvoiceCode() . "\n";
    echo "[Invoice Kbn]: " . $response_data->getInvoiceKbn() . "\n";
    echo "[History Seq]: " . $response_data->getHistorySeq() . "\n";
    echo "[Reminded Kbn]: " . $response_data->getRemindedKbn() . "\n";
    echo "[Company Name]: " . $response_data->getCompanyName() . "\n";
    echo "[Department]: " . $response_data->getDepartment() . "\n";
    echo "[Customer Name]: " . $response_data->getCustomerName() . "\n";
    echo "[Customer Zip]: " . $response_data->getCustomerZip() . "\n";
    echo "[Customer Address1]: " . $response_data->getCustomerAddress1() . "\n";
    echo "[Customer Address2]: " . $response_data->getCustomerAddress2() . "\n";
    echo "[Customer Address3]: " . $response_data->getCustomerAddress3() . "\n";
    echo "[Shop Zip]: " . $response_data->getShopZip() . "\n";
    echo "[Shop Address1]: " . $response_data->getShopAddress1() . "\n";
    echo "[Shop Address2]: " . $response_data->getShopAddress2() . "\n";
    echo "[Shop Address3]: " . $response_data->getShopAddress3() . "\n";
    echo "[Shop Tel]: " . $response_data->getShopTel() . "\n";
    echo "[Shop Fax]: " . $response_data->getShopFax() . "\n";
    echo "[Billed Amount]: " . $response_data->getBilledAmount() . "\n";
    echo "[Tax]: " . $response_data->getTax() . "\n";
    echo "[Time Of Receipts]: " . $response_data->getTimeOfReceipts() . "\n";
    echo "[Invoice Start Date]: " . $response_data->getInvoiceStartDate() . "\n";
    echo "[Invoice Title]: " . $response_data->getInvoiceTitle() . "\n";
    echo "[Nissen Message1]: " . $response_data->getNissenMessage1() . "\n";
    echo "[Nissen Message2]: " . $response_data->getNissenMessage2() . "\n";
    echo "[Nissen Message3]: " . $response_data->getNissenMessage3() . "\n";
    echo "[Nissen Message4]: " . $response_data->getNissenMessage4() . "\n";
    echo "[Invoice Shopsite Name]: " . $response_data->getInvoiceShopsiteName() . "\n";
    echo "[Shop Email]: " . $response_data->getShopEmail() . "\n";
    echo "[Nissen Name]: " . $response_data->getNissenName() . "\n";
    echo "[Nissen Qa Url]: " . $response_data->getNissenQaUrl() . "\n";
    echo "[Shop Order Date]: " . $response_data->getShopOrderDate() . "\n";
    echo "[Shop Code]: " . $response_data->getShopCode() . "\n";
    echo "[Shop Transaction Id1]: " . $response_data->getShopTransactionId1() . "\n";
    echo "[Shop Message1]: " . $response_data->getShopMessage1() . "\n";
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
