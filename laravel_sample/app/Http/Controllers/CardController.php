<?php

namespace App\Http\Controllers;

use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;
use tgMdk\dto\CardAuthorizeRequestDto;
use tgMdk\dto\CardAuthorizeResponseDto;
use tgMdk\dto\PaypayAuthorizeRequestDto;
use tgMdk\TGMDK_Config;
use tgMdk\TGMDK_Logger;
use tgMdk\TGMDK_Transaction;
use App\Accounts;
use App\EntryShibu;
use App\Mail\Contact\ContactAdminMail;
use App\Mail\Contact\ContactMail;
use Illuminate\Support\Facades\Mail;

class CardController extends Controller
{
    public function index()
    {
        return view('card/index')->with(
            [
                'tokenApiKey' => Config::get('sample_setting.token.token_api_key'),
                "amount" => "100",
                "orderId" => Helpers::generateOrderId()
            ]
        );
    }

    public function cardAuthorize(Request $request)
    {

        $logger = Log::channel('tgmdk')->getLogger();
        if ($logger instanceof LoggerInterface) {
            TGMDK_Logger::setLogger($logger);
        }

        $request_data = new CardAuthorizeRequestDto();
        $request_data->setOrderId($request->request->get("orderId"));
        $request_data->setItemCode($request->request->get("serviceOptionType"));
        $request_data->setToken($request->request->get("token"));
        $request_data->setWithCapture($request->request->get("withCapture"));

        $request_data->setJpo(
            Helpers::generateJpo($request->request->get("jpo1"), $request->request->get("jpo2"))
        );


        /*
         * 設定ファイルのパスを手動で指定する場合は以下のようにパスを指定してTGMDK_Configクラスのインスタンス生成をしておく
         * TGMDK_Config::getInstance("/home/test/laravel_sample/config/3GPSMDK.properties");
         */

        $transaction = new TGMDK_Transaction();
        $response_data = $transaction->execute($request_data);

        /*
         * マーチャントIDとマーチャント認証鍵を動的に設定する場合はexecuteメソッドの第2引数に以下のようにセットする
         * $props["merchant_ccid"] = "Set MerchantCCID here";
         * $props["merchant_secret_key"] = "Set MerchantSecretKey here";
         * $response_data = $transaction->execute($request_data, $props);
         */

        if ($response_data instanceof CardAuthorizeResponseDto) {
            $request->session()->put($request->request->get("orderId"), $response_data);
            return redirect()->action(
                'CardController@authorizeResult',
                ['orderId' => $request->request->get("orderId")]
            );
        }

        return view('card/index')->with(
            [
                'tokenApiKey' => Config::get('sample_setting.token.token_api_key'),
                'amount' => $request->request->get("amount")
            ]
        );
    }

    public function authorizeResult($orderId)
    {
      
        $response_data = session($orderId);

        $order_id = $orderId;
        $tour_data = session()->get('tour_data');

        if ($response_data->getMstatus() == 'success') {       
           
            $account = new Accounts();
            $account_data = $account->create([
                'name' => $tour_data['rep_name'],
                'name_kana' => $tour_data['rep_kana'],
                'email' => $tour_data['email'],
                'phone' => $tour_data['tel'],
                'pref' => $tour_data['pref'],
                'adress' => $tour_data['address'],
            ]);

            switch ($tour_data['rep_over20']) {
                case 'はい':
                    $rep_over20 = 1;
                    break;

                default:
                    $rep_over20 = 0;
                    break;
            }


            $search_arr  = ["年", "月", "日"];
            $replace_arr = ["-", "-", ""];
            $tour_date  = str_replace($search_arr, $replace_arr, $tour_data['tour_date']);
    
            $start_time = $tour_data['departure_h'] . ':' . $tour_data['departure_i'];

            $now = date('Y-m-d G:i');
    
            $entry = new EntryShibu();
            $res = $entry->create([
                'start_date' => $tour_date,
                'start_time' => $start_time,
                'start_station' => $tour_data['pickup'],
                'finish_station' => $tour_data['drop'],
                'start_place' => $tour_data['pickup_sup'],
                'finish_place' => $tour_data['drop_sup'],
                'count_1' => $tour_data['adult'],
                'count_2' => $tour_data['child'],
                'count_3' => $tour_data['inf'],
                'adult_check' => $rep_over20,
                'pay_method' => 2,
                'payment' => 18000,
                'payment_date' => $now,
                'account_id' => $account_data->id,
                'payment_id' => $order_id,
            ]);

            $title = '「謎解キ旅行社」ご依頼内容の確認（自動返信メール）';

            $content = $tour_data['rep_name'] .  "様\n\n\n";
            $content .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
            $content .= "本メールはお客様のご依頼内容が弊社に到達した時点で送信される、\n";
            $content .= "自動配信メールです。まだご予約確定ではございません。\n";
            $content .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n\n";
            $content .= "この度は「謎解キ旅行社」をご利用いただき誠にありがとうございます" . "\n\n";
            $content .= "ご依頼いただきました「渋沢栄一の真実(ツアー時間2時間半～3時間)」の空席状況などを確認し、スタッフより回答させていただきます。\n\n\n";
            $content .= "■参加ツアー\n";
            $content .= "渋沢栄一の真実(ツアー時間2時間半～3時間)\n\n";
            $content .= "■参加日/出発時間\n";
            $content .= $tour_data['tour_date'] . " " . $tour_data['departure_h'] . $tour_data['departure_i'] . "\n\n";
            $content .= "■乗車地\n";
            $content .= $tour_data['pickup'] . " " . $tour_data['pickup_sup'] . "\n\n";
            $content .= "■降車地。\n";
            $content .= $tour_data['drop'] . " " . $tour_data['drop_sup'] . "\n\n";
            $content .= "■参加人数\n";
            $content .= "大人" . $tour_data['adult'] . "人 子供(4歳~満12歳)" . $tour_data['child'] . "人 幼児(0歳~満3歳)" . $tour_data['inf'] . "人\n\n";
            $content .= "■代表者を含め、ご参加者の中に20歳以上の方はいらっしゃいますか？\n";
            $content .= $tour_data['rep_over20'] . "\n\n";
            $content .= "■代表者名(漢字)\n";
            $content .= $tour_data['rep_name'] . "\n\n";
            $content .= "■代表者名(カナ)\n";
            $content .= $tour_data['rep_kana'] . "\n\n";
            $content .= "■ご連絡先\n";
            $content .= $tour_data['tel'] . "\n\n";
            $content .= "■メールアドレス\n";
            $content .= $tour_data['email'] . "\n\n";
            $content .= "■住所\n";
            $content .= $tour_data['pref'] . $tour_data['address'] . "\n\n";
            $content .= "■お支払方法\n";
            $content .= $tour_data['payment_method'] . "\n\n";
            $content .= "**************************************************************\n\n";
            $content .= "株式会社キャブステーション\n\n";
            $content .= "社団法人日本旅行業協会 正会員\n";
            $content .= "東京都知事登録旅行業 第2-5160号\n";
            $content .= "東京都品川区西五反田7-22-17 五反田TOCビル3F\n";
            $content .= "tel：03-6880-1475、fax：03-6880-1476\n";
            $content .= "営業時間　平日9:00～17:30\n\n";
            $content .= "**************************************************************";
    
            $mail = new \App\Mail();
            $mail->create([
                'account_id' => $account_data->id,
                'title' => $title,
                'content' => $content,
            ]);

            return redirect()->action('MysteryController@shibusawa_thanks');
            exit;

        }

        $data = [];
        $data['tour_date'] = $tour_data['tour_date'];
        $data['departure_h'] = $tour_data['departure_h'];
        $data['departure_i'] = $tour_data['departure_i'];
        $data['pickup'] = $tour_data['pickup'];
        $data['pickup_sup'] = $tour_data['pickup_sup'];
        $data['drop'] = $tour_data['drop'];
        $data['drop_sup'] = $tour_data['drop_sup'];
        $data['adult'] = $tour_data['adult'];
        $data['child'] = $tour_data['child'];
        $data['inf'] = $tour_data['inf'];
        $data['rep_over20'] = $tour_data['rep_over20'];
        $data['rep_name'] = $tour_data['rep_name'];
        $data['rep_kana'] = $tour_data['rep_kana'];
        $data['tel'] = $tour_data['tel'];
        $data['email'] = $tour_data['email'];
        $data['pref'] = $tour_data['pref'];
        $data['address'] = $tour_data['address'];
        $data['payment_method'] = $tour_data['payment_method'];
        $data['terms'] = '1';

        return view('mystery.event.shibusawa.reserve.confirm',compact('data'))->with('err', 1);
        exit;


        // if ($response_data instanceof CardAuthorizeResponseDto) {
        //     return view('card/result')->with([
        //         'mstatus' => $response_data->getMstatus(),
        //         'vResultCode' => $response_data->getVResultCode(),
        //         'mErrMsg' => $response_data->getMerrMsg(),
        //         'orderId' => $response_data->getOrderId(),
        //         'resAuthCode' => $response_data->getResAuthCode(),
        //         'reqCardNumber' => $response_data->getReqCardNumber()
        //     ]);
        // } else {
        //     return view('card/result')->with([
        //         'mstatus' => null, 'vResultCode' => null, 'mErrMsg' => null, 'orderId' => null, 'resAuthCode' => null,
        //         'reqCardNumber' => null, 'message' => "error!"
        //     ]);
        // }
    }

    public function paypayAuthorize(Request $request)
    {

        $logger = Log::channel('tgmdk')->getLogger();
        if ($logger instanceof LoggerInterface) {
            TGMDK_Logger::setLogger($logger);
        }

        $request_data = new PaypayAuthorizeRequestDto();
        $request_data->setAmount($request->request->get("amount"));
        $request_data->setOrderId($request->request->get("orderId"));
        $request_data->setToken($request->request->get("token"));
        $request_data->setWithCapture($request->request->get("withCapture"));

        $request_data->setJpo(
            Helpers::generateJpo($request->request->get("jpo1"), $request->request->get("jpo2"))
        );


        /*
         * 設定ファイルのパスを手動で指定する場合は以下のようにパスを指定してTGMDK_Configクラスのインスタンス生成をしておく
         * TGMDK_Config::getInstance("/home/test/laravel_sample/config/3GPSMDK.properties");
         */

        $transaction = new TGMDK_Transaction();
        $response_data = $transaction->execute($request_data);

        /*
         * マーチャントIDとマーチャント認証鍵を動的に設定する場合はexecuteメソッドの第2引数に以下のようにセットする
         * $props["merchant_ccid"] = "Set MerchantCCID here";
         * $props["merchant_secret_key"] = "Set MerchantSecretKey here";
         * $response_data = $transaction->execute($request_data, $props);
         */

        if ($response_data instanceof CardAuthorizeResponseDto) {
            $request->session()->put($request->request->get("orderId"), $response_data);
            return redirect()->action(
                'CardController@authorizeResult',
                ['orderId' => $request->request->get("orderId")]
            );
        }

        return view('card/index')->with(
            [
                'tokenApiKey' => Config::get('sample_setting.token.token_api_key'),
                'amount' => $request->request->get("amount")
            ]
        );
    }
}
