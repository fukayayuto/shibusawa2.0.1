<?php

namespace App\scoreatpay;

use tgMdk\dto\ScoreatpayCorrectAuthRequestDto;
use tgMdk\dto\ScoreatpayContactDto;
use tgMdk\dto\ScoreatpayDeliveryDto;
use tgMdk\dto\ScoreatpayDetailDto;
use tgMdk\TGMDK_Transaction;

/*
 * スコア@払い 決済情報修正要求サンプル
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
 * 決済情報修正対象取引IDを指定
 */
$order_id = "";

/**
 * 支払金額
 */
$payment_amount = "100";

/**
 * 注文日
 */
$shop_order_date = "2019/08/16";

/**
 * 決済種別
 *
 * 請求書別送 : 2
 * 請求書同梱 : 3
 */
$payment_type = "2";

/**
 * 購入者情報：フルネーム（漢字）
 */
$full_name = "田中太郎";

/**
 * 購入者情報：フルネーム（カナ）
 */
$full_kana_name = "タナカタロウ";

/**
 * 購入者情報：電話番号
 */
$tel = "0312345678";

/**
 * 購入者情報：携帯電話番号
 */
$mobile = "08000123456";

/**
 * 購入者情報：メールアドレス
 */
$email = "hoge@example.com";

/**
 * 購入者情報：携帯メールアドレス
 */
$mobile_email = "hoge@example.com";

/**
 * 購入者情報：郵便番号
 */
$zip_code = "1500013";

/**
 * 購入者情報：住所（都道府県）
 */
$address1 = "東京都";

/**
 * 購入者情報：住所（市区町村）
 */
$address2 = "渋谷区";

/**
 * 購入者情報：住所（市区町村以降）
 */
$address3 = "恵比寿";

/**
 * 購入者情報：会社名
 */
$company_name = "会社名";

/**
 * 購入者情報：部署名
 */
$department_name = "部署名";

/**
 * 配送先情報：配送先ID
 */
$delivery_id = "12345678";

/**
 * 配送先情報：連絡先
 */
$contact = null;

/**
 * 配送先情報：明細
 */
$details = array();

/**
 * 明細：明細名
 */
$detail_name = "商品名";

/**
 * 明細：単価
 */
$detail_price = "100";

/**
 * 明細：数量
 */
$detail_quantity = "1";

/**
 * 要求電文パラメータ値の指定
 */
$request_data = new ScoreatpayCorrectAuthRequestDto();

$request_data->setOrderId($order_id);
$request_data->setAmount($payment_amount);
$request_data->setShopOrderDate($shop_order_date);
$request_data->setPaymentType($payment_type);

$buyer_contact = new ScoreatpayContactDto();
$buyer_contact->setFullName($full_name);
$buyer_contact->setFullKanaName($full_kana_name);
$buyer_contact->setTel($tel);
$buyer_contact->setMobile($mobile);
$buyer_contact->setEmail($email);
$buyer_contact->setMobileEmail($mobile_email);
$buyer_contact->setZipCode($zip_code);
$buyer_contact->setAddress1($address1);
$buyer_contact->setAddress2($address2);
$buyer_contact->setAddress3($address3);
$buyer_contact->setCompanyName($company_name);
$buyer_contact->setDepartmentName($department_name);
$request_data->setBuyerContact($buyer_contact);

$delivery = new ScoreatpayDeliveryDto();
$contact = $buyer_contact;
$delivery->setContact($contact);
$delivery->setDeliveryId($delivery_id);
$detail = new ScoreatpayDetailDto();
$detail->setDetailName($detail_name);
$detail->setDetailPrice($detail_price);
$detail->setDetailQuantity($detail_quantity);
array_push($details, $detail);
$delivery->setDetails($details);
$request_data->setDelivery($delivery);

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
    echo "[Author Result]:" . $response_data->getAuthorResult() . "\n";
// 失敗
} else if (TXN_FAILURE_CODE === $txn_status) {
    echo $txn_status . "\n";
    echo "Transaction Failure\n";
    echo "[Message]: " . $error_message . "\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "[Order ID]: " . $response_data->getOrderId() . "\n";
    echo "[Nissen Transaction Id]:" . $response_data->getNissenTransactionId() . "\n";
    echo "[Author Result]:" . $response_data->getAuthorResult() . "\n";
    if (!is_null($response_data->getErrors())) {
        foreach ($response_data->getErrors() as $error) {
            echo "[Error Code]: " . $error->getErrorCode() . "\n";
            echo "[Error Message]: " . $error->getErrorMessage() . "\n";
        }
    }
    echo "Check log file for more information\n";
}
