<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Reserve\SendMail;
use App\Mail\Reserve\AdminMail;
use App\Mail\Contact\ContactAdminMail;
use App\Mail\Contact\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Accounts;
use App\EntryShibu;
use App\Helpers;
use Illuminate\Foundation\Console\Presets\React;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;
use tgMdk\dto\CardAuthorizeRequestDto;
use tgMdk\dto\CardAuthorizeResponseDto;
use tgMdk\TGMDK_Config;
use tgMdk\TGMDK_Logger;
use tgMdk\TGMDK_Transaction;
use Symfony\Component\HttpFoundation\Session\Session;


class MysteryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function shibusawa_index()
    {
        $data = [];
        $data['tour_date'] = '';
        $data['departure_h'] = '';
        $data['departure_i'] = '';
        $data['pickup'] = '';
        $data['pickup_sup'] = '';
        $data['drop'] = '';
        $data['drop_sup'] = '';
        $data['adult'] = '';
        $data['child'] = '';
        $data['inf'] = '';
        $data['rep_over20'] = '';
        $data['rep_name'] = '';
        $data['rep_kana'] = '';
        $data['tel'] = '';
        $data['email'] = '';
        $data['pref'] = '';
        $data['address'] = '';
        $data['payment_method'] = '';
        $data['terms'] = '';


        return view('mystery.event.shibusawa.reserve.index', compact('data'));
        // return view('mystery.event.shibusawa.reserve.index',compact('data'))->with('sawYakkan',$sawYakkan)->with('sawJyoken',$sawJyoken);
    }
    public function shibusawa_confirm(Request $request)
    {
        $data = [];
        $data['tour_date'] = $request->tour_date;
        $data['departure_h'] = $request->departure_h;
        $data['departure_i'] = $request->departure_i;
        $data['pickup'] = $request->pickup;
        $data['pickup_sup'] = $request->pickup_sup;
        $data['drop'] = $request->drop;
        $data['drop_sup'] = $request->drop_sup;
        $data['adult'] = $request->adult;
        $data['child'] = $request->child;
        $data['inf'] = $request->inf;
        $data['rep_over20'] = $request->rep_over20;
        $data['rep_name'] = $request->rep_name;
        $data['rep_kana'] = $request->rep_kana;
        $data['tel'] = $request->tel;
        $data['email'] = $request->email;
        $data['pref'] = $request->pref;
        $data['address'] = $request->address;
        $data['payment_method'] = $request->payment_method;
        $data['terms'] = $request->terms;

        return view('mystery.event.shibusawa.reserve.confirm', compact('data'))->with('err',0);
    }

    public function shibusawa_fix(Request $request)
    {
        $data = [];
        $data['tour_date'] = $request->tour_date;
        $data['departure_h'] = $request->departure_h;
        $data['departure_i'] = $request->departure_i;
        $data['pickup'] = $request->pickup;
        $data['pickup_sup'] = $request->pickup_sup;
        $data['drop'] = $request->drop;
        $data['drop_sup'] = $request->drop_sup;
        $data['adult'] = $request->adult;
        $data['child'] = $request->child;
        $data['inf'] = $request->inf;
        $data['rep_over20'] = $request->rep_over20;
        $data['rep_name'] = $request->rep_name;
        $data['rep_kana'] = $request->rep_kana;
        $data['tel'] = $request->tel;
        $data['email'] = $request->email;
        $data['pref'] = $request->pref;
        $data['address'] = $request->address;
        $data['payment_method'] = $request->payment_method;
        $data['terms'] = $request->terms;


        return view('mystery.event.shibusawa.reserve.index', compact('data'));
    }

    public function shibusawa_reserve_store(Request $request)
    {
        $data = [];
        $data['tour_date'] = $request->tour_date;
        $data['departure_h'] = $request->departure_h;
        $data['departure_i'] = $request->departure_i;
        $data['pickup'] = $request->pickup;
        $data['pickup_sup'] = $request->pickup_sup;
        $data['drop'] = $request->drop;
        $data['drop_sup'] = $request->drop_sup;
        $data['adult'] = $request->adult;
        $data['child'] = $request->child;
        $data['inf'] = $request->inf;
        $data['rep_over20'] = $request->rep_over20;
        $data['rep_name'] = $request->rep_name;
        $data['rep_kana'] = $request->rep_kana;
        $data['tel'] = $request->tel;
        $data['email'] = $request->email;
        $data['pref'] = $request->pref;
        $data['payment_method'] = $request->payment_method;
        $data['address'] = $request->address;

        // session()->put('tour_data', $data);

        // if ($request->payment_method == 'クレジット') {
        //     return view('card/index',compact('data'))->with(
        //         [
        //             'tokenApiKey' => Config::get('sample_setting.token.token_api_key'),
        //             "amount" => "18000",
        //             "orderId" => Helpers::generateOrderId(),
        //         ]
        //     );
        // }

    
        // $template = new MailTemplate();
        // $method = '[渋沢用]予約の確定メール(ユーザー送信用)';
        // $template_data = $template->select_data_from_method($method);

        // $search_arr  = [
        //     "{{tour_date}}", 
        //     "{{departure_h}}",
        //     "{{departure_i}}",
        //     "{{pick_up}}", 
        //     "{{pickup_sup}}",
        //     "{{drop}}",
        //     "{{drop_sup}}",
        //     "{{adult}}", 
        //     "{{child}}",
        //     "{{inf}}",
        //     "{{rep_over20}}",
        //     "{{rep_name}}", 
        //     "{{rep_kana}}",
        //     "{{tel}}", 
        //     "{{email}}",
        //     "{{pref}}",
        //     "{{address}}"
        //     ,"{{payment_method}}"
        // ];
        // $replace_arr = [
        //     $request->tour_date,
        //     $request->departure_h,
        //     $request->departure_i,
        //     $request->pick_up,
        //     $request->pickup_sup,
        //     $request->drop,
        //     $request->drop_sup,
        //     $request->adult,
        //     $request->adult,
        //     $request->child,
        //     $request->inf,
        //     $request->rep_over20,
        //     $request->rep_name,
        //     $request->rep_kana,
        //     $request->tel,
        //     $request->email,
        //     $request->pref,
        //     $request->address,
        //     $request->payment_method,
        // ];
        // $content  = str_replace($search_arr, $replace_arr, $template_data->content);


        //管理者に対してメール
        Mail::send(new AdminMail($data));

        //予約者に対してメール
        Mail::send(new SendMail($data));


        $account = new Accounts();
        $account_data = $account->create([
            'name' => $request->rep_name,
            'name_kana' => $request->rep_kana,
            'email' => $request->email,
            'phone' => $request->tel,
            'pref' => $request->pref,
            'adress' => $request->address,
        ]);


        switch ($request->rep_over20) {
            case 'はい':
                $request->rep_over20 = 1;
                break;

            default:
                $request->rep_over20 = 0;
                break;
        }

        switch ($request->payment_method) {
            case "銀行振込":
                $pay_method = 1;
                break;
            case "クレジット":
                $pay_method = 2;
                break;
            case "paypay":
                $pay_method = 3;
                break;
            default:
                $pay_method = 1;
                break;
        }

        $search_arr  = ["年", "月", "日"];
        $replace_arr = ["-", "-", ""];
        $tour_date  = str_replace($search_arr, $replace_arr, $request->tour_date);

        $start_time = $request->departure_h . ':' . $request->departure_i;

        $payment_id = Helpers::generateOrderId();

        $entry = new EntryShibu();
        $res = $entry->create([
            'start_date' => $tour_date,
            'start_time' => $start_time,
            'start_station' => $request->pickup,
            'finish_station' => $request->drop,
            'start_place' => $request->pickup_sup,
            'finish_place' => $request->drop_sup,
            'count_1' => $request->adult,
            'count_2' => $request->child,
            'count_3' => $request->inf,
            'adult_check' => $request->rep_over20,
            'pay_method' => $pay_method ,
            'account_id' => $account_data->id,
            'payment_id' => $payment_id,
        ]);

        $title = '「謎解キ旅行社」ご依頼内容の確認（自動返信メール）';

        $content = $request->rep_name .  "様\n\n\n";
        $content .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $content .= "本メールはお客様のご依頼内容が弊社に到達した時点で送信される、\n";
        $content .= "自動配信メールです。まだご予約確定ではございません。\n";
        $content .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n\n";
        $content .= "この度は「謎解キ旅行社」をご利用いただき誠にありがとうございます" . "\n\n";
        $content .= "ご依頼いただきました「渋沢栄一の真実(ツアー時間2時間半～3時間)」の空席状況などを確認し、スタッフより回答させていただきます。\n\n\n";
        $content .= "■参加ツアー\n";
        $content .= "渋沢栄一の真実(ツアー時間2時間半～3時間)\n\n";
        $content .= "■参加日/出発時間\n";
        $content .= $request->tour_date . " " . $request->departure_h . $request->departure_i . "\n\n";
        $content .= "■乗車地\n";
        $content .= $request->pick_up . " " . $request->pickup_sup . "\n\n";
        $content .= "■降車地。\n";
        $content .= $request->drop . " " . $request->drop_sup . "\n\n";
        $content .= "■参加人数\n";
        $content .= "大人" . $request->adult . "人 子供(4歳~満12歳)" . $request->child . "人 幼児(0歳~満3歳)" . $request->inf . "人\n\n";
        $content .= "■代表者を含め、ご参加者の中に20歳以上の方はいらっしゃいますか？\n";
        $content .= $request->rep_over20 . "\n\n";
        $content .= "■代表者名(漢字)\n";
        $content .= $request->rep_name . "\n\n";
        $content .= "■代表者名(カナ)\n";
        $content .= $request->rep_kana . "\n\n";
        $content .= "■ご連絡先\n";
        $content .= $request->tel . "\n\n";
        $content .= "■メールアドレス\n";
        $content .= $request->email . "\n\n";
        $content .= "■住所\n";
        $content .= $request->pref . $request->address . "\n\n";
        $content .= "■お支払方法\n";
        $content .= $request->payment_method . "\n\n";
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

    public function shibusawa_thanks()
    {
        return view('mystery.event.shibusawa.reserve.thanks');
    }

    public function contact()
    {
        $data = [];
        $data['name'] = '';
        $data['email'] = '';
        $data['tel'] = '';
        $data['subject'] = '';
        $data['message'] = '';

        return view('mystery.contact.index', compact('data'));
    }

    public function contact_confirm(Request $request)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['tel'] = $request->tel;
        $data['subject'] = $request->subject;
        $data['message'] = $request->message;

        return view('mystery.contact.confirm', compact('data'));
    }

    public function contact_fix(Request $request)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['tel'] = $request->tel;
        $data['subject'] = $request->subject;
        $data['message'] = $request->message;

        return view('mystery.contact.index', compact('data'));
    }

    public function contact_thanks(Request $request)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['tel'] = $request->tel;
        $data['subject'] = $request->subject;
        $data['message'] = $request->message;


        //管理者に対してメール
        Mail::send(new ContactAdminMail($data));

        //予約者に対してメール
        Mail::send(new ContactMail($data));

        return view('mystery.contact.thanks', compact('data'));
    }
}
