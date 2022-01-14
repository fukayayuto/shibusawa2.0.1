<?php

namespace App\search;

use tgMdk\dto\AlipaySearchParameter;
use tgMdk\dto\BankSearchParameter;
use tgMdk\dto\CommonSearchParameter;
use tgMdk\dto\CvsSearchParameter;
use tgMdk\dto\EmSearchParameter;
use tgMdk\dto\LinepaySearchParameter;
use tgMdk\dto\MasterpassSearchParameter;
use tgMdk\dto\OricoscSearchParameter;
use tgMdk\dto\PaypalSearchParameter;
use tgMdk\dto\RakutenSearchParameter;
use tgMdk\dto\RecruitSearchParameter;
use tgMdk\dto\SaisonSearchParameter;
use tgMdk\dto\SearchParameters;
use tgMdk\dto\SearchRange;
use tgMdk\dto\SearchRequestDto;
use tgMdk\dto\UpopSearchParameter;
use tgMdk\dto\PaypaySearchParameter;
use tgMdk\dto\AmazonpaySearchParameter;
use tgMdk\dto\ScoreatpaySearchParameter;
use tgMdk\dto\MerpaySearchParameter;
use tgMdk\dto\VirtualaccSearchParameter;
use tgMdk\dto\MpiSearchParameter;
use tgMdk\TGMDK_Transaction;

/*
 * Created on 2010/02/22
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */


/**
 * ステータスコード
 */
define('TXN_FAILURE_CODE', 'failure');
define('TXN_PENDING_CODE', 'pending');
define('TXN_SUCCESS_CODE', 'success');
define('TRUE_CODE', 'true');

define('CARD_SERVICE', 'card');
define('E_MONEY_SERVICE', 'em');
define('CONVINIENCE_SERVICE', 'cvs');
define('BANK_SERVICE', 'bank');
define('PAYPAL_SERVICE', 'paypal');
define('SAISON_SERVICE', 'saison');
define('ALIPAY_SERVICE', 'alipay');
define('ORICOSC_SERVICE', 'oricosc');
define('RAKUTEN_SERVICE', 'rakuten');
define('RECRUIT_SERVICE', 'recruit');
define('LINEPAY_SERVICE', 'linepay');
define('MASTERPASS_SERVICE', 'masterpass');
define('VIRTUALACC_SERVICE', 'virtualacc');
define('UPOP_SERVICE', 'upop');
define('PAYPAY_SERVICE', 'paypay');
define('AMAZONPAY_SERVICE', 'amazonpay');
define('SCOREATPAY_SERVICE', 'scoreatpay');
define('MERPAY_SERVICE', 'merpay');
define('MPI_SERVICE', 'mpi');

require_once("../../vendor/autoload.php");
require_once("../LoggerDefine.php");

/**
 * 要求電文パラメータ
 *
 */

/**
 * 1. 対象リクエストID
 */
$request_id = "";

/**
 * 2. サービスタイプ
 * 配列指定
 *
 * クレジットカード：card
 * 電子マネー：em
 * コンビニ：cvs
 * 銀行：bank
 * PayPal:paypal
 * Saison:saison
 * Alipay:alipay
 * 楽天:rakuten
 * リクルート:recruit
 * LINE Pay:linepay
 * MasterPass:masterpass
 * 銀行振込:virtualacc
 * UPOP:upop
 * PayPay:paypay
 * Amazon Pay:amazonpay
 * スコア@払い:scoreatpay
 * メルペイ:merpay
 * 本人認証:mpi
 */

$service_code1 = CARD_SERVICE;
$service_code2 = E_MONEY_SERVICE;
$service_code3 = CONVINIENCE_SERVICE;
$service_code4 = BANK_SERVICE;
$service_code5 = PAYPAL_SERVICE;
$service_code7 = SAISON_SERVICE;
$service_code8 = ALIPAY_SERVICE;
$service_code9 = ORICOSC_SERVICE;
$service_code10 = RAKUTEN_SERVICE;
$service_code11 = RECRUIT_SERVICE;
$service_code12 = LINEPAY_SERVICE;
$service_code13 = MASTERPASS_SERVICE;
$service_code14 = VIRTUALACC_SERVICE;
$service_code15 = UPOP_SERVICE;
$service_code16 = PAYPAY_SERVICE;
$service_code17 = AMAZONPAY_SERVICE;
$service_code18 = SCOREATPAY_SERVICE;
$service_code19 = MERPAY_SERVICE;
$service_code20 = MPI_SERVICE;

$service_type = array($service_code1);
array_push($service_type, $service_code20);

/**
 * 3. 検索最大件数
 */
$max_count = "10";

/**
 * 要求電文に条件セット
 */
$request_data = new SearchRequestDto();
$request_data->setRequestId($request_id);
$request_data->setServiceTypeCd($service_type);
$request_data->setMaxCount($max_count);

/**
 * サービス間検索条件パラメータ値
 */

/**
 * 1. 取引ID
 */
$order_id = "";

/**
 * 2. 対象コマンド
 * 配列指定
 *
 * Authorize/Reauthorize/Capture/Cancel/Refund/Retry/Verify
 */
$command1 = "Authorize";
$command2 = "Capture";
$command3 = "Cancel";
$command4 = "Refund";
$command5 = "Remove";

$target_command = array($command1);
array_push($target_command, $command1);

/**
 * 3. 対象取引ステータス
 * 配列指定
 *
 * success/failure/pending
 */
$status1 = "success";
$status2 = "pending";
$status3 = "failure";

$transaction_status = array($status1);
array_push($transaction_status, $status2);
//array_push($transaction_status, $status3);

/**
 * 4-a. 取引日時
 * yyyyMMDDhhmm
 */
$txn_from_datetime = "202001140000";
$txn_to_datetime = "202001142359";

/**
 * 5-a. 取引金額
 */
$amount_lower_limit = "1";
$amount_upper_limit = "10000";

/**
 * 4-b. 検索範囲設定：取引期間
 */
$txn_time_range = new SearchRange();
$txn_time_range->setFrom($txn_from_datetime);
$txn_time_range->setTo($txn_to_datetime);

/**
 * 5-b. 検索範囲設定：取引金額
 */
$amount_range = new SearchRange();
$amount_range->setFrom($amount_lower_limit);
$amount_range->setTo($amount_upper_limit);

/**
 * サービス間共通検索パラメータ設定(1-5)
 */
$common_parameters = new CommonSearchParameter();

$common_parameters->setOrderId($order_id);
$common_parameters->setCommand($target_command);
$common_parameters->setMstatus($transaction_status);
$common_parameters->setTxnDatetime($txn_time_range);
$common_parameters->setAmount($amount_range);


/**
 * 以下、サービス別指定
 */

/**
 * 電子マネー固有検索パラメータ
 * EmSearchParameter
 */

/**
 * 電子マネー種別
 * 配列指定
 *
 * edy/suica/waon/tcc
 */
$em_code1 = "edy";
$em_code2 = "suica";
$em_code3 = "waon";
$em_code4 = "tcc";

$em_type = array($em_code1);

/**
 * 検索範囲設定：決済期限日時
 */
//検索始点 YYYYMMDDhhmm
$settlement_from_datetime = "201005010000";

//検索終点 YYYYMMDDhhmm
$settlement_to_datetime = "201005312359";

$settlement_limit_range = new SearchRange();
$settlement_limit_range->setFrom($settlement_from_datetime);
$settlement_limit_range->setTo($settlement_to_datetime);

/**
 * 検索範囲設定：決済完了日時
 */
//検索始点 YYYYMMDDhhmm
$complete_from_datetime = "201005010000";

//検索終点 YYYYMMDDhhmm
$complete_to_datetime = "201005312359";

$complete_datetime_range = new SearchRange();
$complete_datetime_range->setFrom($complete_from_datetime);
$complete_datetime_range->setTo($complete_to_datetime);

$em_parameters = new EmSearchParameter();
$em_parameters->setEmType($em_type);
$em_parameters->setSettlementLimit($settlement_limit_range);
$em_parameters->setCompleteDatetime($complete_datetime_range);

/**
 * コンビニ固有検索パラメータ
 * CvsSearchParameter
 */

/**
 * コンビニ種別
 * セブンイレブン:sej
 * イーコンテクスト：econ
 * ウェルネット：other
 */

$convini_code1 = "sej";
$convini_code4 = "other";
$convini_code5 = "econ";

$cvs_type = array($convini_code1);
//array_push($cvs_type, $convini_code1);

/**
 * 検索範囲設定：支払期限日時
 */
//検索始点 YYYYMMDDhhmm
$pay_from_datetime = "201005010000";

//検索終点 YYYYMMDDhhmm
$pay_to_datetime = "201005312359";

$pay_limit_range = new SearchRange();
$pay_limit_range->setFrom($pay_from_datetime);
$pay_limit_range->setTo($pay_to_datetime);

/**
 * 検索範囲設定：入金受付日
 */
//検索始点 YYYYMMDDhhmm
$paid_from_datetime = "201005010000";

//検索終点 YYYYMMDDhhmm
$paid_to_datetime = "201005312359";

$paid_datetime_range = new SearchRange();
$paid_datetime_range->setFrom($paid_from_datetime);
$paid_datetime_range->setTo($paid_to_datetime);

$cvs_parameters = new CvsSearchParameter();
$cvs_parameters->setCvsType($cvs_type);
$cvs_parameters->setPayLimit($pay_limit_range);
$cvs_parameters->setPaidDatetime($paid_datetime_range);

/**
 * PayEasy固有検索パラメータ
 * BankSearchParameter
 */

/**
 * 方式種別
 * ATM決済 ： atm
 * ネットバンク決済PC : netbank-pc
 * ネットバンク決済DoCoMo ： netbank-docomo
 * ネットバンク決済SoftBank ： netbank-sonftbank
 * ネットバンク決済au ： netbank-au
 */

$bank_option1 = "atm";
$bank_option2 = "netbank-pc";
$bank_option3 = "netbank-docomo";
$bank_option4 = "netbank-softbank";
$bank_option5 = "netbank-au";

$bank_option_type = array($bank_option1);
//$array_push($bank_option_type, $bank_option2);

/**
 * 検索範囲設定：支払期限日時
 */
//検索始点 YYYYMMDDhhmm
$pay_from_datetime = "201005010000";

//検索終点 YYYYMMDDhhmm
$pay_to_datetime = "201005312359";

$pay_limit_range = new SearchRange();
$pay_limit_range->setFrom($pay_from_datetime);
$pay_limit_range->setTo($pay_to_datetime);

/**
 * 検索範囲設定：収納日時
 */
//検索始点 YYYYMMDDhhmm
$received_from_datetime = "201005010000";

//検索終点 YYYYMMDDhhmm
$received_to_datetime = "201005312359";

$received_datetime_range = new SearchRange();
$received_datetime_range->setFrom($received_from_datetime);
$received_datetime_range->setTo($received_to_datetime);

$bank_parameters = new BankSearchParameter();
$bank_parameters->setOptionType($bank_option_type);
$bank_parameters->setPayLimit($pay_limit_range);
$bank_parameters->setReceivedDatetime($received_datetime_range);

/**
 * PayPal固有検索パラメータ
 *  PaypalSearchParameter
 */

/**
 * 検索範囲設定：支払日時
 */
//検索始点 YYYYMMDDhhmm
$payment_from_datetime = "201005010000";

//検索終点 YYYYMMDDhhmm
$payment_to_datetime = "201005312359";

$payment_range = new SearchRange();
$payment_range->setFrom($payment_from_datetime);
$payment_range->setTo($payment_to_datetime);

/**
 * 顧客番号
 */
$payer_id = "dummy";

$paypal_parameters = new PaypalSearchParameter();
$paypal_parameters->setPaymentDatetime($payment_range);
$paypal_parameters->setPayerId($payer_id);


/**
 * Saison固有検索パラメータ
 *  SaisonSearchParameter
 */

// サービス固有項目の画面パラメータを取得
$saison_totalAmountFrom = "100"; // 合計決済金額 From
$saison_totalAmountTo = "100"; // 合計決済金額 To
$saison_walletAmountFrom = ""; // ウォレット決済金額 From
$saison_walletAmountTo = ""; // ウォレット決済金額 To
$saison_cardAmountFrom = ""; // カード決済金額 From
$saison_cardAmountTo = ""; // カード決済金額 To

// 合計決済金額の範囲指定パラメータを生成
$saison_totalAmountRange = new SearchRange();
$saison_totalAmountRange->setFrom($saison_totalAmountFrom);
$saison_totalAmountRange->setTo($saison_totalAmountTo);

// ウォレット決済金額の範囲指定パラメータを生成
$saison_walletAmountRange = new SearchRange();
$saison_walletAmountRange->setFrom($saison_walletAmountFrom);
$saison_walletAmountRange->setTo($saison_walletAmountTo);

// カード決済金額の範囲指定パラメータを生成
$saison_cardAmountRange = new SearchRange();
$saison_cardAmountRange->setFrom($saison_cardAmountFrom);
$saison_cardAmountRange->setTo($saison_cardAmountTo);

// 設定
$saison_parameters = new SaisonSearchParameter();
$saison_parameters->setTotalAmount($saison_totalAmountRange);
$saison_parameters->setWalletAmount($saison_walletAmountRange);
$saison_parameters->setCardAmount($saison_cardAmountRange);

/**
 * ショッピングクレジット固有検索パラメータ
 */
// サービス固有項目の画面パラメータを取得
$oricosc_oricoOrderNo = "dummy1368601754";          // 注文番号
$oricosc_amountFrom = "1";           // 支払金額合計From
$oricosc_amountTo = "1000";           // 支払金額合計To
$oricosc_totalItemAmountFrom = "1";  // 商品価格合計From
$oricosc_totalItemAmountTo = "1000";  // 商品価格合計To

// 支払合計金額の範囲指定パラメータを生成
$oricosc_amountRange = new SearchRange();
$oricosc_amountRange->setFrom($oricosc_amountFrom);
$oricosc_amountRange->setTo($oricosc_amountTo);

// 商品価格合計の範囲指定パラメータを生成
$oricosc_totalItemAmountRange = new SearchRange();
$oricosc_totalItemAmountRange->setFrom($oricosc_totalItemAmountFrom);
$oricosc_totalItemAmountRange->setTo($oricosc_totalItemAmountTo);

// 設定
$oricosc_parameters = new OricoscSearchParameter();
$oricosc_parameters->setOricoOrderNo($oricosc_oricoOrderNo);
$oricosc_parameters->setAmount($oricosc_amountRange);
$oricosc_parameters->setTotalItemAmount($oricosc_totalItemAmountRange);

/**
 * 楽天ID決済固有検索パラメータ
 */
// サービス固有項目の画面パラメータを取得
$rakuten_itemId = "12*"; // 商品番号
$rakuten_detailOrderType = array("Init", "Auth");
$rakuten_detailCommandType = array("Init", "PreAuth");

// 設定
$rakuten_parameters = new RakutenSearchParameter();
$rakuten_parameters->setItemId($rakuten_itemId);
$rakuten_parameters->setDetailOrderType($rakuten_detailOrderType);
$rakuten_parameters->setDetailCommandType($rakuten_detailCommandType);

/**
 * リクルートかんたん支払い固有検索パラメータ
 */
// サービス固有項目の画面パラメータを取得
$recruit_itemId = "12*"; // 商品番号
$recruit_detailOrderType = array("Init", "Auth");
$recruit_detailCommandType = array("Init", "PreAuth");

// 設定
$recruit_parameters = new RecruitSearchParameter();
$recruit_parameters->setItemId($rakuten_itemId);
$recruit_parameters->setDetailOrderType($recruit_detailOrderType);
$recruit_parameters->setDetailCommandType($recruit_detailCommandType);

/**
 * LINE Pay固有検索パラメータ
 */
// サービス固有項目の画面パラメータを取得
$linepay_itemId = "12*"; // 商品番号
$linepay_detailOrderType = array("Init", "Auth");
$linepay_detailCommandType = array("Init", "PreAuth");

// 設定
$linepay_parameters = new LinepaySearchParameter();
$linepay_parameters->setItemId($linepay_itemId);
$linepay_parameters->setDetailOrderType($linepay_detailOrderType);
$linepay_parameters->setDetailCommandType($linepay_detailCommandType);

/**
 * MasterPass固有検索パラメータ
 */
// サービス固有項目の画面パラメータを取得
$masterpass_itemId = "12*"; // 商品番号
$masterpass_detailOrderType = array("Init", "Auth");
$masterpass_detailCommandType = array("Init", "Auth");

// 設定
$masterpass_parameters = new MasterpassSearchParameter();
$masterpass_parameters->setItemId($masterpass_itemId);
$masterpass_parameters->setDetailOrderType($masterpass_detailOrderType);
$masterpass_parameters->setDetailCommandType($masterpass_detailCommandType);

/**
 * 銀行振込決済固有検索パラメータ
 */
// サービス固有項目の画面パラメータを取得
$virtualacc_detailOrderType = array("Init", "Auth");
$virtualacc_detailCommandType = array("Init", "Auth");
$virtualacc_entryTransferName = "";
$virtualacc_entryTransferNumber = "";
$virtualacc_accountNumber = "";

// 設定
$virtualacc_parameters = new VirtualaccSearchParameter();
$virtualacc_parameters->setDetailOrderType($virtualacc_detailOrderType);
$virtualacc_parameters->setDetailCommandType($virtualacc_detailCommandType);
$virtualacc_parameters->setEntryTransferName($virtualacc_entryTransferName);
$virtualacc_parameters->setEntryTransferNumber($virtualacc_entryTransferNumber);
$virtualacc_parameters->setAccountNumber($virtualacc_accountNumber);

/**
 * Alipay固有検索パラメータ
 */
// サービス固有項目の画面パラメータを取得
$alipay_detailOrderType = array("payment", "refund");
$alipay_centerTradeId = "";
/**
 * 検索範囲設定：支払い日時
 */
// 検索始点 YYYYMMDDhhmm
$alipay_payment_from_datetime = "201005010000";
// 検索終点 YYYYMMDDhhmm
$alipay_payment_to_datetime = "201005312359";
$alipay_payment_range = new SearchRange();
$alipay_payment_range->setFrom($alipay_payment_from_datetime);
$alipay_payment_range->setTo($alipay_payment_to_datetime);
/**
 * 検索範囲設定：清算日時
 */
// 検索始点 YYYYMMDDhhmm
$alipay_settlement_from_datetime = "201005010000";
// 検索終点 YYYYMMDDhhmm
$alipay_settlement_to_datetime = "201005312359";
$alipay_settlement_range = new SearchRange();
$alipay_settlement_range->setFrom($alipay_settlement_from_datetime);
$alipay_settlement_range->setTo($alipay_settlement_to_datetime);
// 決済種別
$alipay_payType = array("0", "1", "2");

// 設定
$alipay_parameters = new AlipaySearchParameter();
$alipay_parameters->setDetailOrderType($alipay_detailOrderType);
$alipay_parameters->setCenterTradeId($alipay_centerTradeId);
$alipay_parameters->setPaymentTime($alipay_payment_range);
$alipay_parameters->setSettlementTime($alipay_settlement_range);
$alipay_parameters->setPayType($alipay_payType);

/**
 * 銀聯ネット決済(UPOP)固有検索パラメータ
 */
// サービス固有項目の画面パラメータを取得
/**
 * 検索範囲設定：決済日時(日本)
 */
// 検索始点 YYYYMMDDhhmm
$upop_settle_from_datetime_jp = "201005010000";
// 検索終点 YYYYMMDDhhmm
$upop_settle_to_datetime_jp = "201005312359";
$upop_settle_range_jp = new SearchRange();
$upop_settle_range_jp->setFrom($upop_settle_from_datetime_jp);
$upop_settle_range_jp->setTo($upop_settle_to_datetime_jp);
// /**
//  * 検索範囲設定：決済日時(中国)
//  */
// // 検索始点 YYYYMMDDhhmm
// $upop_settle_from_datetime_cn = "201005010000";
// // 検索終点 YYYYMMDDhhmm
// $upop_settle_to_datetime_cn = "201005312359";
// $upop_settle_range_cn = new SearchRange();
// $upop_settle_range_cn->setFrom($upop_settle_from_datetime_cn);
// $upop_settle_range_cn->setTo($upop_settle_to_datetime_cn);

$upop_detailOrderType = array("a", "ac");

// 設定
$upop_parameters = new UpopSearchParameter();
$upop_parameters->setSettleDatetimeJp($upop_settle_range_jp);
// $upop_parameters->setSettleDatetimeCn($upop_settle_range_cn);
$upop_parameters->setDetailOrderType($upop_detailOrderType);

/**
 * PayPay固有検索パラメータ
 */
// サービス固有項目の画面パラメータを取得
$paypay_detailOrderType = array("Init", "Auth");
$paypay_detailCommandType = array("Init", "PreAuth");
$paypay_paypayServiceType = array("online");

// 設定
$paypay_parameters = new PaypaySearchParameter();
$paypay_parameters->setDetailOrderType($paypay_detailOrderType);
$paypay_parameters->setDetailCommandType($paypay_detailCommandType);
$paypay_parameters->setPaypayServiceType($paypay_paypayServiceType);

/**
 * Amazon Pay固有検索パラメータ
 */
// サービス固有項目の画面パラメータを取得
$amazonpay_detailOrderType = array("Init", "Auth");
$amazonpay_detailCommandType = array("Init", "PreAuth");
$amazonpay_centerOrderId = "12345678";
$amazonpay_centerTransactionId = "12345678";
$amazonpay_accountingType = "1";
$amazonpay_consentStatus = array("Init", "Consent");
$amazonpay_originalOrderId = "12345678";

// 設定
$amazonpay_parameters = new AmazonpaySearchParameter();
$amazonpay_parameters->setDetailOrderType($amazonpay_detailOrderType);
$amazonpay_parameters->setDetailCommandType($amazonpay_detailCommandType);
$amazonpay_parameters->setCenterOrderId($amazonpay_centerOrderId);
$amazonpay_parameters->setCenterTransactionId($amazonpay_centerTransactionId);
$amazonpay_parameters->setAccountingType($amazonpay_accountingType);
$amazonpay_parameters->setConsentStatus($amazonpay_consentStatus);
$amazonpay_parameters->setOriginalOrderId($amazonpay_originalOrderId);

/**
 * スコア@払い固有検索パラメータ
 */
// サービス固有項目の画面パラメータを取得
$scoreatpay_detailOrderType = array("Auth", "Hold", "PostAuth", "VoidAuth", "VoidHold", "VoidPostAuth", "ExpiredAuth");
$scoreatpay_detailCommandType = array("Auth", "CorrectAuth", "Confirm", "PostAuth", "PostingAuth", "GetInvoiceData", "VoidAuth", "VoidHold", "VoidPostAuth", "ExpiredAuth");
$scoreatpay_lastAuthResult = array("OK", "NG", "HD", "HR");

// 設定
$scoreatpay_parameters = new ScoreatpaySearchParameter();
$scoreatpay_parameters->setDetailOrderType($scoreatpay_detailOrderType);
$scoreatpay_parameters->setDetailCommandType($scoreatpay_detailCommandType);
$scoreatpay_parameters->setLastAuthorResult($scoreatpay_lastAuthResult);

/**
 * メルペイ固有検索パラメータ
 */
// サービス固有項目の画面パラメータを取得
$merpay_merpayProcessingId = "12345678";
$merpay_detailOrderType = array("Init", "AuthCapture", "VoidAuthCapture");
$merpay_detailCommandType = array("Init", "AuthCapture", "VoidAuthCapture");
$merpay_merpayServiceType = array("online", "barcode");
$merpay_accountingType = array("0", "1");
$merpay_inquiryCode = "12345678";

// 設定
$merpay_parameters = new MerpaySearchParameter();
$merpay_parameters->setMerpayProcessingId($merpay_merpayProcessingId);
$merpay_parameters->setDetailOrderType($merpay_detailOrderType);
$merpay_parameters->setDetailCommandType($merpay_detailCommandType);
$merpay_parameters->setMerpayServiceType($merpay_merpayServiceType);
$merpay_parameters->setAccountingType($merpay_accountingType);
$merpay_parameters->setInquiryCode($merpay_inquiryCode);

/**
 * 本人認証固有検索パラメータ
 */
// サービス固有項目の画面パラメータを取得
$mpi_detailOrderType = array("auth");
$mpi_res3dTransactionId = "12345678";
$mpi_res3dTransactionStatus = "12345678";
$mpi_res3dEci = "01";
$mpi_deviceChannel = array("02");
$mpi_accountType = array("01");
$mpi_authenticationIndicator = array("01");
$mpi_messageCategory = array("01");

// 設定
$mpi_parameters = new MpiSearchParameter();
$mpi_parameters->setDetailOrderType($mpi_detailOrderType);
$mpi_parameters->setRes3dTransactionId($mpi_res3dTransactionId);
$mpi_parameters->setRes3dTransactionStatus($mpi_res3dTransactionStatus);
$mpi_parameters->setRes3dEci($mpi_res3dEci);
$mpi_parameters->setDeviceChannel($mpi_deviceChannel);
$mpi_parameters->setAccountType($mpi_accountType);
$mpi_parameters->setAuthenticationIndicator($mpi_authenticationIndicator);
$mpi_parameters->setMessageCategory($mpi_messageCategory);


/**
 * 取引結果検索条件設定
 * 対象サービスの検索パラメータを必要に応じてセット
 */
$search_target_condition = new SearchParameters();
$search_target_condition->setCommon($common_parameters);
// for 電子マネー決済取引
// $search_target_condition->setEm($em_parameters);
// for コンビニ決済取引
// $search_target_condition->setCvs($cvs_parameters);
// for PayEasy決済取引
// $search_target_condition->setBank($bank_parameters);
// for PayPal決済取引
// $search_target_condition->setPaypal($paypal_parameters);
// for Saison決済取引
// $search_target_condition->setSaison($saison_parameters);
// for ショッピングクレジット決済取引
// $search_target_condition->setOricosc($oricosc_parameters);
// for 楽天ID決済取引
// $search_target_condition->setRakuten($rakuten_parameters);
// for リクルートかんたん支払い取引
// $search_target_condition->setRecruit($recruit_parameters);
// for LINE Pay取引
// $search_target_condition->setLinepay($linepay_parameters);
// for MasterPass取引
// $search_target_condition->setMasterpass($masterpass_parameters);
// for 銀行振込決済取引
// $search_target_condition->setVirtualacc($virtualacc_parameters);
// for Alipay決済取引
// $search_target_condition->setAlipay($alipay_parameters);
// for 銀聯ネット決済(UPOP)取引
// $search_target_condition->setUpop($upop_parameters);
// for PayPay取引
// $search_target_condition->setPaypay($paypay_parameters);
// for Amazon Pay取引
// $search_target_condition->setAmazonpay($amazonpay_parameters);
// for スコア@払い取引
// $search_target_condition->setScoreatpay($scoreatpay_parameters);
// for メルペイ取引
// $search_target_condition->setMerpay($merpay_parameters);
// for 本人認証取引
// $search_target_condition->setMpi($mpi_parameters);

/**
 * 取引結果検索条件を要求電文パラメータへ設定
 */
$request_data->setSearchParameters($search_target_condition);
$request_data->setContainDummyFlag("1");

/**
 * 検索実行
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
 *  結果表示
 */

//ペンディング
if (TXN_PENDING_CODE === $txn_status) {
    echo $txn_status . "\n";
    echo "Transaction Pending\n";
    echo "[Message]: " . $error_message . "\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "Check log file for more information\n";
    // 失敗
} else if (TXN_FAILURE_CODE === $txn_status) {
    echo $txn_status . "\n";
    echo "Transaction Failure\n";
    echo "[Message]: " . $error_message . "\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "[Order ID]: " . $response_data->getOrderId() . "\n";
    echo "Check log file for more information\n";
    // 成功
} else if (TXN_SUCCESS_CODE === $txn_status) {
    echo $txn_status . "\n";
    echo "Transaction Successfully Complete\n";
    echo "[Result Code]: " . $txn_result_code . "\n";
    echo "[Search Count]: " . $response_data->getSearchCount() . "\n";
    if (TRUE_CODE == $response_data->getOverMaxCountFlag()) {
        echo "Over Search Max Count\n";
    }
    /**
     * 検索結果内オーダ情報
     */
    $orders = $response_data->getOrderInfos()->getOrderInfo();

    echo "\n----- Search Results -----\n\n";
    foreach ($orders as $order) {
        echo "*---------**---------*" . "\n";
        echo "Index: " . $order->getIndex() . "\n";
        echo "Service Type: " . $order->getServiceTypeCd() . "\n";
        echo "Order ID: " . $order->getOrderId() . "\n";
        echo "Order Status: " . $order->getOrderStatus() . "\n";

        $is_card = FALSE;
        $is_em = FALSE;
        $is_cvs = FALSE;
        $is_bank = FALSE;
        $is_paypal = FALSE;
        $is_oricosc = FALSE;
        $is_rakuten = FALSE;
        $is_recruit = FALSE;
        $is_linepay = FALSE;
        $is_masterpass = FALSE;
        $is_virtualacc = FALSE;
        $is_alipay = FALSE;
        $is_upop = FALSE;
        $is_paypay = FALSE;
        $is_amazonpay = FALSE;
        $is_scoreatpay = FALSE;
        $is_merpay = FALSE;
        $is_mpi = FALSE;

        /*
         * オーダ情報区分チェック
         */
        switch ($order->getServiceTypeCd()) {
            case CARD_SERVICE:
                $is_card = TRUE;
                break;
            case E_MONEY_SERVICE:
                $is_em = TRUE;
                break;
            case CONVINIENCE_SERVICE:
                $is_cvs = TRUE;
                break;
            case BANK_SERVICE:
                $is_bank = TRUE;
                break;
            case PAYPAL_SERVICE:
                $is_paypal = TRUE;
                break;
            case ORICOSC_SERVICE:
                $is_oricosc = TRUE;
                break;
            case RAKUTEN_SERVICE:
                $is_rakuten = TRUE;
                break;
            case RECRUIT_SERVICE:
                $is_recruit = TRUE;
                break;
            case LINEPAY_SERVICE:
                $is_linepay = TRUE;
                break;
            case MASTERPASS_SERVICE:
                $is_masterpass = TRUE;
                break;
            case VIRTUALACC_SERVICE:
                $is_virtualacc = TRUE;
                break;
            case ALIPAY_SERVICE:
                $is_alipay = TRUE;
                break;
            case UPOP_SERVICE:
                $is_upop = TRUE;
                break;
            case PAYPAY_SERVICE:
                $is_paypay = TRUE;
                break;
            case AMAZONPAY_SERVICE:
                $is_amazonpay = TRUE;
                break;
            case SCOREATPAY_SERVICE:
                $is_scoreatpay = TRUE;
                break;
            case MERPAY_SERVICE:
                $is_merpay = TRUE;
                break;
            case MPI_SERVICE:
                $is_mpi = TRUE;
                break;
            default:
                echo "[Error] Undefined Service Transaction\n";
                echo "Contact to support\n";
                break;
        }

        /**
         * 固有オーダ情報（サービス別）
         * サンプルでは、カード決済・楽天・リクルート・LINE Pay・MasterPass,銀行振込決済の例を実装しています
         */
        $proper_order_info = $order->getProperOrderInfo();
        if ($is_card) {
            echo "Card Transaction ID: " . $proper_order_info->getStartTxn() . "\n";
            echo "Currency: " . $proper_order_info->getRequestCurrencyUnit() . "\n";
        }
        if ($is_rakuten) {
            echo "With Capture: " . $proper_order_info->getWithCapture() . "\n";
            echo "Item Name: " . $proper_order_info->getItemName() . "\n";
            echo "Item ID: " . $proper_order_info->getItemId() . "\n";
            echo "Authorize Amount: " . $proper_order_info->getAuthorizeAmount() . "\n";
            echo "Balance: " . $proper_order_info->getBalance() . "\n";
            echo "Auhotrize Datetime: " . $proper_order_info->getAuthorizeDatetime() . "\n";
            echo "Rakuten Order ID: " . $proper_order_info->getRakutenOrderId() . "\n";
        }
        if ($is_recruit) {
            echo "With Capture: " . $proper_order_info->getWithCapture() . "\n";
            echo "Item Name: " . $proper_order_info->getItemName() . "\n";
            echo "Item ID: " . $proper_order_info->getItemId() . "\n";
            echo "Authorize Amount: " . $proper_order_info->getAuthorizeAmount() . "\n";
            echo "Balance: " . $proper_order_info->getBalance() . "\n";
            echo "Auhotrize Datetime: " . $proper_order_info->getAuthorizeDatetime() . "\n";
            echo "Recruit Order ID: " . $proper_order_info->getRecruitOrderId() . "\n";
        }
        if ($is_linepay) {
            echo "With Capture: " . $proper_order_info->getWithCapture() . "\n";
            echo "Item Name: " . $proper_order_info->getItemName() . "\n";
            echo "Item ID: " . $proper_order_info->getItemId() . "\n";
            echo "Authorize Amount: " . $proper_order_info->getAuthorizeAmount() . "\n";
            echo "Balance: " . $proper_order_info->getBalance() . "\n";
            echo "Auhotrize Datetime: " . $proper_order_info->getAuthorizeDatetime() . "\n";
            echo "Linepay Order ID: " . $proper_order_info->getLinepayOrderId() . "\n";
        }
        if ($is_masterpass) {
            echo "With Capture: " . $proper_order_info->getWithCapture() . "\n";
            echo "Item ID: " . $proper_order_info->getItemId() . "\n";
            echo "Item Amount: " . $proper_order_info->getItemAmount() . "\n";
            echo "Authorize Amount: " . $proper_order_info->getAuthorizeAmount() . "\n";
            echo "Auhotrize Datetime: " . $proper_order_info->getAuthorizeDatetime() . "\n";
            echo "Masterpass Order ID: " . $proper_order_info->getMasterpassOrderId() . "\n";
            echo "Card Order ID: " . $proper_order_info->getCardOrderId() . "\n";
            echo "Acquirer Code: " . $proper_order_info->getAcquirerCode() . "\n";
            echo "Card Number: " . $proper_order_info->getCardNumber() . "\n";
        }
        if ($is_virtualacc) {
            echo "Total Deposit Amount: " . $proper_order_info->getTotalDepositAmount() . "\n";
            echo "Entry Transfer Name: " . $proper_order_info->getEntryTransferName() . "\n";
            echo "Entry Transfer Number: " . $proper_order_info->getEntryTransferNumber() . "\n";
            echo "Accounting Type: " . $proper_order_info->getAccountingType() . "\n";
            echo "Account Manage Type: " . $proper_order_info->getAccountManageType() . "\n";
        }
        if ($is_paypay) {
            echo "PayPay Order Id: " . $proper_order_info->getPaypayOrderId() . "\n";
            echo "PayPay Service Type: " . $proper_order_info->getPaypayServiceType() . "\n";
            echo "Authorize Amount: " . $proper_order_info->getAuthorizeAmount() . "\n";
            echo "Balance: " . $proper_order_info->getBalance() . "\n";
            echo "Authorize Datetime: " . $proper_order_info->getAuthorizeDatetime() . "\n";
            echo "Refund Datetime: " . $proper_order_info->getRefundDatetime() . "\n";
            echo "Capture Datetime: " . $proper_order_info->getCaptureDatetime() . "\n";
            echo "Cancel Datetime: " . $proper_order_info->getCancelDatetime() . "\n";
            echo "With Capture: " . $proper_order_info->getWithCapture() . "\n";
            echo "Item Id: " . $proper_order_info->getItemId() . "\n";
        }
        if ($is_amazonpay) {
            echo "Authorize Amount: " . $proper_order_info->getAuthorizeAmount() . "\n";
            echo "Capture Amount: " . $proper_order_info->getCaptureAmount() . "\n";
            echo "Refundable Amount: " . $proper_order_info->getRefundableAmount() . "\n";
            echo "Balance: " . $proper_order_info->getBalance() . "\n";
            echo "Authorize Datetime: " . $proper_order_info->getAuthorizeDatetime() . "\n";
            echo "Center Order Id: " . $proper_order_info->getCenterOrderId() . "\n";
            echo "Accounting Type: " . $proper_order_info->getAccountingType() . "\n";
            echo "Consent Status: " . $proper_order_info->getConsentStatus() . "\n";
            echo "Frequency Unit: " . $proper_order_info->getFrequencyUnit() . "\n";
            echo "Frequency Value: " . $proper_order_info->getFrequencyValue() . "\n";
            echo "Original Order Id: " . $proper_order_info->getOriginalOrderId() . "\n";
            echo "Ondemand Amount: " . $proper_order_info->getOdAmount() . "\n";
        }
        if ($is_merpay) {
            echo "Merpay Service Type: " . $proper_order_info->getMerpayServiceType() . "\n";
            echo "Accounting Type: " . $proper_order_info->getAccountingType() . "\n";
            echo "With Capture: " . $proper_order_info->getWithCapture() . "\n";
            echo "Authorize Amount: " . $proper_order_info->getAuthorizeAmount() . "\n";
            echo "Capture Amount: " . $proper_order_info->getCaptureAmount() . "\n";
            echo "Balance: " . $proper_order_info->getBalance() . "\n";
            echo "Authorize Datetime: " . $proper_order_info->getAuthorizeDatetime() . "\n";
        }
        if ($is_mpi) {
            echo "Start Txn: " . $proper_order_info->getStartTxn() . "\n";
            echo "Ddd Message Version: " . $proper_order_info->getDddMessageVersion() . "\n";
            echo "Request Currency Unit: " . $proper_order_info->getRequestCurrencyUnit() . "\n";
            echo "Card Expire: " . $proper_order_info->getCardExpire() . "\n";
            echo "Device Channel: " . $proper_order_info->getDeviceChannel() . "\n";
            echo "Account Type: " . $proper_order_info->getAccountType() . "\n";
            echo "Authentication Indicator: " . $proper_order_info->getAuthenticationIndicator() . "\n";
            echo "Message Category: " . $proper_order_info->getMessageCategory() . "\n";
        }
        /**
         * 取引情報
         */
        $order_transactions = $order->getTransactionInfos()->getTransactionInfo();
        foreach ($order_transactions as $order_transaction) {
            echo "----" . "\n";
            echo "Transaction ID: " . $order_transaction->getTxnId() . "\n";
            echo "Executed Command: " . $order_transaction->getCommand() . "\n";
            echo "Transaction Status: " . $order_transaction->getMStatus() . "\n";
            echo "Transaction Result Code: " . $order_transaction->getVResultCode() . "\n";
            echo "Execute Time: " . $order_transaction->getTxnDatetime() . "\n";
            echo "Settlement Amount: " . $order_transaction->getAmount() . "\n";

            $proper_transaction_info = $order_transaction->getProperTransactionInfo();
            if ($proper_transaction_info !== null) {
                if ($is_card) {
                    echo "Card Transaction Type: " . $proper_transaction_info->getCardTransactionType() . "\n";
                    echo "Gateway Request Date: " . $proper_transaction_info->getGatewayRequestDate() . "\n";
                    echo "Gateway Response Date: " . $proper_transaction_info->getGatewayResponseDate() . "\n";
                    echo "Center Request Date: " . $proper_transaction_info->getCenterRequestDate() . "\n";
                    echo "Center Response Date: " . $proper_transaction_info->getCenterResponseDate() . "\n";
                    echo "Center Request Number: " . $proper_transaction_info->getCenterRequestNumber() . "\n";
                    echo "Center Reference Number: " . $proper_transaction_info->getCenterReferenceNumber() . "\n";
                    echo "Request Auth Code: " . $proper_transaction_info->getReqAuthCode() . "\n";
                }
                if ($is_rakuten) {
                    echo "Rakuten API Error Code: " . $proper_transaction_info->getRakutenApiErrorCode() . "\n";
                    echo "Rakuten Order Error Code: " . $proper_transaction_info->getRakutenOrderErrorCode() . "\n";
                    echo "Rakuten Request Datetime: " . $proper_transaction_info->getRakutenRequestDatetime() . "\n";
                    echo "Rakuten Response Datetime: " . $proper_transaction_info->getRakutenResponseDatetime() . "\n";
                }
                if ($is_recruit) {
                    echo "Recruit Error Code: " . $proper_transaction_info->getRecruitErrorCode() . "\n";
                    echo "Recruit Request Datetime: " . $proper_transaction_info->getRecruitRequestDatetime() . "\n";
                    echo "Recruit Response Datetime: " . $proper_transaction_info->getRecruitResponseDatetime() . "\n";
                }
                if ($is_linepay) {
                    echo "Linepay Error Code: " . $proper_transaction_info->getLinepayErrorCode() . "\n";
                    echo "Linepay Request Datetime: " . $proper_transaction_info->getLinepayRequestDatetime() . "\n";
                    echo "Linepay Response Datetime: " . $proper_transaction_info->getLinepayResponseDatetime() . "\n";
                }
                if ($is_masterpass) {
                    echo "Masterpass Auth Code: " . $proper_transaction_info->getAuthCode() . "\n";
                    echo "Masterpass ReferenceNumber: " . $proper_transaction_info->getReferenceNumber() . "\n";
                    echo "Masterpass DetailCommandType: " . $proper_transaction_info->getDetailCommandType() . "\n";
                    echo "Masterpass CardVResultCode: " . $proper_transaction_info->getCardVResultCode() . "\n";
                    echo "Masterpass Request Datetime: " . $proper_transaction_info->getMasterpassRequestDatetime() . "\n";
                    echo "Masterpass Response Datetime: " . $proper_transaction_info->getMasterpassResponseDatetime() . "\n";
                }
                if ($is_virtualacc) {
                    echo "Virtualacc With Reconcile: " . $proper_transaction_info->getWithReconcile() . "\n";
                    echo "Virtualacc Deposit Id: " . $proper_transaction_info->getDepositId() . "\n";
                    echo "Virtualacc Registration Method: " . $proper_transaction_info->getRegistrationMethod() . "\n";
                    echo "Virtualacc Deposit Date: " . $proper_transaction_info->getDepositDate() . "\n";
                    echo "Virtualacc Transfer Name: " . $proper_transaction_info->getTransferName() . "\n";
                }
                if ($is_alipay) {
                    echo "Alipay Center Trade Id: " . $proper_transaction_info->getCenterTradeId() . "\n";
                    echo "Alipay Txn Type: " . $proper_transaction_info->getAlipayTxnType() . "\n";
                    echo "Alipay Settle Amount: " . $proper_transaction_info->getSettleAmount() . "\n";
                    echo "Alipay Settle Currency: " . $proper_transaction_info->getSettleCurrency() . "\n";
                    echo "Alipay Payment Time: " . $proper_transaction_info->getPaymentTime() . "\n";
                    echo "Alipay Settlement Time: " . $proper_transaction_info->getSettlementTime() . "\n";
                    echo "Alipay Pay Type: " . $proper_transaction_info->getPayType() . "\n";
                }
                if ($is_upop) {
                    echo "UPOP Settle Amount: " . $proper_transaction_info->getResUpopSettleAmount() . "\n";
                    echo "UPOP Settle Date: " . $proper_transaction_info->getResUpopSettleDate() . "\n";
                    echo "UPOP Settle Currency: " . $proper_transaction_info->getResUpopSettleCurrency() . "\n";
                    echo "UPOP Exchange Date: " . $proper_transaction_info->getResUpopExchangeDate() . "\n";
                    echo "UPOP Exchange Rate: " . $proper_transaction_info->getResUpopExchangeRate() . "\n";
                    echo "UPOP Upop Order Id: " . $proper_transaction_info->getResUpopOrderId() . "\n";
                }
                if ($is_paypay) {
                    echo "PAYPAY Paypay Result Code: " . $proper_transaction_info->getPaypayResultCode() . "\n";
                    echo "PAYPAY Detail Command Type: " . $proper_transaction_info->getDetailCommandType() . "\n";
                    echo "PAYPAY Item Name: " . $proper_transaction_info->getItemName() . "\n";
                    echo "PAYPAY Request Datetime: " . $proper_transaction_info->getPaypayRequestDatetime() . "\n";
                    echo "PAYPAY Response Datetime: " . $proper_transaction_info->getPaypayResponseDatetime() . "\n";
                    echo "PAYPAY Online Txn Id: " . $proper_transaction_info->getPaypayOnlineTxnId() . "\n";
                    echo "PAYPAY Error Code: " . $proper_transaction_info->getPaypayErrorCode() . "\n";
                }
                if ($is_amazonpay) {
                    echo "Amazonpay Center Transaction Id: " . $proper_transaction_info->getCenterTransactionId() . "\n";
                    echo "Amazonpay Center Resuld Code: " . $proper_transaction_info->getCenterResultCode() . "\n";
                    echo "Amazonpay Center State Code: " . $proper_transaction_info->getCenterStateCode() . "\n";
                    echo "Amazonpay Center Reason Code: " . $proper_transaction_info->getCenterReasonCode() . "\n";
                    echo "Amazonpay Detail Command Type: " . $proper_transaction_info->getDetailCommandType() . "\n";
                    echo "Amazonpay Center Request Datetime: " . $proper_transaction_info->getCenterRequestDatetime() . "\n";
                    echo "Amazonpay Center Response Datetime: " . $proper_transaction_info->getCenterResponseDatetime() . "\n";
                    echo "Amazonpay Frequency Unit: " . $proper_transaction_info->getFrequencyUnit() . "\n";
                    echo "Amazonpay Frequency Value: " . $proper_transaction_info->getFrequencyValue() . "\n";
                }
                if ($is_scoreatpay) {
                    if ($proper_transaction_info != null) {
                        echo "Scoreatpay Author Result: " . $proper_transaction_info->getAuthorResult() . "\n";
                    }
                }
                if ($is_merpay) {
                    echo "Merpay Error Code: " . $proper_transaction_info->getMerpayErrorCode() . "\n";
                    echo "Merpay Detail Command Type: " . $proper_transaction_info->getDetailCommandType() . "\n";
                    echo "Merpay Store Id: " . $proper_transaction_info->getStoreId() . "\n";
                    echo "Merpay Terminal Id: " . $proper_transaction_info->getTerminalId() . "\n";
                    echo "Merpay Operator Id: " . $proper_transaction_info->getOperatorId() . "\n";
                    echo "Merpay Slip Code: " . $proper_transaction_info->getSlipCode() . "\n";
                    echo "Merpay Resource Id: " . $proper_transaction_info->getMerpayResourceId() . "\n";
                    echo "Merpay Processing Id: " . $proper_transaction_info->getMerpayProcessingId() . "\n";
                    echo "Merpay Request Datetime: " . $proper_transaction_info->getMerpayRequestDatetime() . "\n";
                    echo "Merpay Response Datetime: " . $proper_transaction_info->getMerpayResponseDatetime() . "\n";
                    echo "Merpay Inquiry Code: " . $proper_transaction_info->getInquiryCode() . "\n";
                }
                if ($is_mpi) {
                    # 本人認証固有
                    echo "Mpi Txn Kind: " . $proper_transaction_info->getTxnKind() . "\n";
                    echo "Mpi Mpi Transaction Type: " . $proper_transaction_info->getMpiTransactionType() . "\n";
                    echo "Mpi Req Card Number: " . $proper_transaction_info->getReqCardNumber() . "\n";
                    echo "Mpi Req Card Expire: " . $proper_transaction_info->getReqCardExpire() . "\n";
                    echo "Mpi Req Amount: " . $proper_transaction_info->getReqAmount() . "\n";
                    echo "Mpi Req Redirection Uri: " . $proper_transaction_info->getReqRedirectionUri() . "\n";
                    echo "Mpi Corporation Id: " . $proper_transaction_info->getCorporationId() . "\n";
                    echo "Mpi Brand Id: " . $proper_transaction_info->getBrandId() . "\n";
                    echo "Mpi Acquirer Binary: " . $proper_transaction_info->getAcquirerBinary() . "\n";
                    echo "Mpi Ds Login Id: " . $proper_transaction_info->getDsLoginId() . "\n";
                    echo "Mpi Crres Status: " . $proper_transaction_info->getCrresStatus() . "\n";
                    echo "Mpi Veres Status: " . $proper_transaction_info->getVeresStatus() . "\n";
                    echo "Mpi Pares Sign: " . $proper_transaction_info->getParesSign() . "\n";
                    echo "Mpi Pares Status: " . $proper_transaction_info->getParesStatus() . "\n";
                    echo "Mpi Pares Eci: " . $proper_transaction_info->getParesEci() . "\n";
                    echo "Mpi Auth Response Code: " . $proper_transaction_info->getAuthResponseCode() . "\n";
                    echo "Mpi Verify Response Code: " . $proper_transaction_info->getVerifyResponseCode() . "\n";
                    echo "Mpi Res3d Message Version: " . $proper_transaction_info->getRes3dMessageVersion() . "\n";
                    echo "Mpi Res3d Transaction Id: " . $proper_transaction_info->getRes3dTransactionId() . "\n";
                    echo "Mpi Res3d Ds Transaction Id: " . $proper_transaction_info->getRes3dDsTransactionId() . "\n";
                    echo "Mpi Res3d Server Transaction Id: " . $proper_transaction_info->getRes3dServerTransactionId() . "\n";
                    echo "Mpi Res3d Transaction Status: " . $proper_transaction_info->getRes3dTransactionStatus() . "\n";
                    echo "Mpi Res3d Cavv Algorithm: " . $proper_transaction_info->getRes3dCavvAlgorithm() . "\n";
                    echo "Mpi Res3d Cavv: " . $proper_transaction_info->getRes3dCavv() . "\n";
                    echo "Mpi Res3d Eci: " . $proper_transaction_info->getRes3dEci() . "\n";
                    echo "Mpi Auth Request Datetime: " . $proper_transaction_info->getAuthRequestDatetime() . "\n";
                    echo "Mpi Auth Response Datetime: " . $proper_transaction_info->getAuthResponseDatetime() . "\n";
                    echo "Mpi Verify Request Datetime: " . $proper_transaction_info->getVerifyRequestDatetime() . "\n";
                    echo "Mpi Verify Response Datetime: " . $proper_transaction_info->getVerifyResponseDatetime() . "\n";
                    echo "Mpi Req Currency Unit: " . $proper_transaction_info->getReqCurrencyUnit() . "\n";
                    echo "Mpi Req Acquirer Code: " . $proper_transaction_info->getReqAcquirerCode() . "\n";
                    echo "Mpi Req Item Code: " . $proper_transaction_info->getReqItemCode() . "\n";
                    echo "Mpi Req Card Center: " . $proper_transaction_info->getReqCardCenter() . "\n";
                    echo "Mpi Req Jpo Information: " . $proper_transaction_info->getReqJpoInformation() . "\n";
                    echo "Mpi Req Sales Day: " . $proper_transaction_info->getReqSalesDay() . "\n";
                    echo "Mpi Req With Capture: " . $proper_transaction_info->getReqWithCapture() . "\n";
                    echo "Mpi Req Security Code: " . $proper_transaction_info->getReqSecurityCode() . "\n";
                    echo "Mpi Req Birthday: " . $proper_transaction_info->getReqBirthday() . "\n";
                    echo "Mpi Req Tel: " . $proper_transaction_info->getReqTel() . "\n";
                    echo "Mpi Req First Kana Name: " . $proper_transaction_info->getReqFirstKanaName() . "\n";
                    echo "Mpi Req Last Kana Name: " . $proper_transaction_info->getReqLastKanaName() . "\n";
                    # カード固有
                    echo "Mpi Txn Kind: " . $proper_transaction_info->getTxnKind() . "\n";
                    echo "Mpi Card Transaction Type: " . $proper_transaction_info->getCardTransactionType() . "\n";
                    echo "Mpi Gateway Request Date: " . $proper_transaction_info->getGatewayRequestDate() . "\n";
                    echo "Mpi Gateway Response Date: " . $proper_transaction_info->getGatewayResponseDate() . "\n";
                    echo "Mpi Center Request Date: " . $proper_transaction_info->getCenterRequestDate() . "\n";
                    echo "Mpi Center Response Date: " . $proper_transaction_info->getCenterResponseDate() . "\n";
                    echo "Mpi Center Request Number: " . $proper_transaction_info->getCenterRequestNumber() . "\n";
                    echo "Mpi Center Reference Number: " . $proper_transaction_info->getCenterReferenceNumber() . "\n";
                    echo "Mpi Req Item Code: " . $proper_transaction_info->getReqItemCode() . "\n";
                    echo "Mpi Res Item Code: " . $proper_transaction_info->getResItemCode() . "\n";
                    echo "Mpi Req Return Reference Number: " . $proper_transaction_info->getReqReturnReferenceNumber() . "\n";
                    echo "Mpi Responsedata: " . $proper_transaction_info->getResponsedata() . "\n";
                    echo "Mpi Pending: " . $proper_transaction_info->getPending() . "\n";
                    echo "Mpi Loopback: " . $proper_transaction_info->getLoopback() . "\n";
                    echo "Mpi Connected Center Id: " . $proper_transaction_info->getConnectedCenterId() . "\n";
                    echo "Mpi Req Card Number: " . $proper_transaction_info->getReqCardNumber() . "\n";
                    echo "Mpi Req Card Expire: " . $proper_transaction_info->getReqCardExpire() . "\n";
                    echo "Mpi Req Amount: " . $proper_transaction_info->getReqAmount() . "\n";
                    echo "Mpi Req Card Option Type: " . $proper_transaction_info->getReqCardOptionType() . "\n";
                    echo "Mpi Req Merchant Transaction: " . $proper_transaction_info->getReqMerchantTransaction() . "\n";
                    echo "Mpi Req Auth Code: " . $proper_transaction_info->getReqAuthCode() . "\n";
                    echo "Mpi Req Acquirer Code: " . $proper_transaction_info->getReqAcquirerCode() . "\n";
                    echo "Mpi Req Card Center: " . $proper_transaction_info->getReqCardCenter() . "\n";
                    echo "Mpi Req Jpo Information: " . $proper_transaction_info->getReqJpoInformation() . "\n";
                    echo "Mpi Req Sales Day: " . $proper_transaction_info->getReqSalesDay() . "\n";
                    echo "Mpi Req Cancel Day: " . $proper_transaction_info->getReqCancelDay() . "\n";
                    echo "Mpi Req With Capture: " . $proper_transaction_info->getReqWithCapture() . "\n";
                    echo "Mpi Req With Direct: " . $proper_transaction_info->getReqWithDirect() . "\n";
                    echo "Mpi Req3d Message Version: " . $proper_transaction_info->getReq3dMessageVersion() . "\n";
                    echo "Mpi Req3d Transaction Id: " . $proper_transaction_info->getReq3dTransactionId() . "\n";
                    echo "Mpi Req3d Transaction Status: " . $proper_transaction_info->getReq3dTransactionStatus() . "\n";
                    echo "Mpi Req3d Cavv Algorithm: " . $proper_transaction_info->getReq3dCavvAlgorithm() . "\n";
                    echo "Mpi Req3d Cavv: " . $proper_transaction_info->getReq3dCavv() . "\n";
                    echo "Mpi Req3d Eci: " . $proper_transaction_info->getReq3dEci() . "\n";
                    echo "Mpi Req3d Ds Transaction Id: " . $proper_transaction_info->getReq3dDsTransactionId() . "\n";
                    echo "Mpi Req3d Server Transaction Id: " . $proper_transaction_info->getReq3dServerTransactionId() . "\n";
                    echo "Mpi Req Security Code: " . $proper_transaction_info->getReqSecurityCode() . "\n";
                    echo "Mpi Req Auth Flag: " . $proper_transaction_info->getReqAuthFlag() . "\n";
                    echo "Mpi Req Birthday: " . $proper_transaction_info->getReqBirthday() . "\n";
                    echo "Mpi Req Tel: " . $proper_transaction_info->getReqTel() . "\n";
                    echo "Mpi Req First Kana Name: " . $proper_transaction_info->getReqFirstKanaName() . "\n";
                    echo "Mpi Req Last Kana Name: " . $proper_transaction_info->getReqLastKanaName() . "\n";
                    echo "Mpi Res Merchant Transaction: " . $proper_transaction_info->getResMerchantTransaction() . "\n";
                    echo "Mpi Res Return Reference Number: " . $proper_transaction_info->getResReturnReferenceNumber() . "\n";
                    echo "Mpi Res Auth Code: " . $proper_transaction_info->getResAuthCode() . "\n";
                    echo "Mpi Res Action Code: " . $proper_transaction_info->getResActionCode() . "\n";
                    echo "Mpi Res Center Error Code: " . $proper_transaction_info->getResCenterErrorCode() . "\n";
                    echo "Mpi Res Auth Term: " . $proper_transaction_info->getResAuthTerm() . "\n";
                    echo "Mpi Req With New: " . $proper_transaction_info->getReqWithNew() . "\n";
                    echo "Mpi Jpy Amount: " . $proper_transaction_info->getJpyAmount() . "\n";
                    echo "Mpi Res Mcp Response Code: " . $proper_transaction_info->getResMcpResponseCode() . "\n";
                }
            } else {
                echo "Proper Transaction Info is not exist" . "\n";
            }
        } // end of transactions
    }// end of orders
}


