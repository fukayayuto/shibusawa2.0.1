<?php

namespace App\Http\Controllers;

use App\Mail;
use Illuminate\Http\Request;
use App\AccountShibu;
use App\Accounts;
use App\ReserveType;
use App\Reserve;
use App\Entry;
use App\EntryShibu;
use DateTime;
use Alert;
use App\MailTemplate;
use App\Mail\Admin\SendMail;

class MailController extends Controller
{
    //初期表示画面
    public function index()
    {
        $mail = new Mail();
        $mail_data_list = $mail->get_data_all();

        $week = array("日", "月", "火", "水", "木", "金", "土");

        $mail_data = [];
        foreach ($mail_data_list as $k => $val) {
            $tmp = [];

            $tmp['id'] = $val->id;
            $tmp_created_at = new DateTime($val->created_at);
            $tmp['created_at'] = $tmp_created_at->format('n月j日');
            $tmp['created_at'] .= '(' . $week[$tmp_created_at->format("w")] . ')';
            $tmp['created_at'] .= $tmp_created_at->format('G:i');

            $tmp['title'] = $val->title;
            $tmp['content'] = $val->content;

            $account = new Accounts();
            $account_data = $account->select_data($val->account_id);

            $tmp['account_name'] = $account_data->name;
            $tmp['email'] = $account_data->email;
            $tmp['account_id'] = $account_data->id;

            $mail_data[$k] = $tmp;
        }


        return view('admin.mail.index', compact('mail_data'));
    }

    //初期表示画面(メールアドレス検索)
    public function mail_search(Request $request)
    {
        $email = $request->email;

        $account = new Accounts();
        $account_data_list  = $account->search_data_from_email($email);


        $mail_data_list = [];
        $i = 0;
        foreach ($account_data_list as $account_data) {
            $tmp = [];
            $mail = new Mail();
            $mail_data = $mail->serach_data_from_account_id($account_data->id);
            foreach ($mail_data as $item) {
                $mail_data_list[$i] = $item;
                $i++;
            }
        }

        $mail_data = [];
        if (!empty($mail_data_list)) {
            foreach ($mail_data_list as $k => $val) {
                $tmp = [];

                $tmp['id'] = $val->id;
                $tmp_created_at = new DateTime($val->created_at);
                $tmp['created_at'] = $tmp_created_at->format('n月j日 G:i');

                $tmp['title'] = $val->title;
                $tmp['content'] = $val->content;

                $account = new Accounts();
                $account_data = $account->select_data($val->account_id);

                $tmp['account_name'] = $account_data->name;
                $tmp['email'] = $account_data->email;

                $mail_data[$k] = $tmp;
            }
        }
        return view('admin.mail.index', compact('mail_data'))->with('email', $email);
    }

    //初期表示画面
    public function mail_detail($id)
    {
        $mail = new Mail();
        $mail_data = $mail->select_data($id);

        $tmp_created_at = new DateTime($mail_data->created_at);
        $mail_data->created_at = $tmp_created_at->format('n月j日 G:i');

        $account = new Accounts();
        $account_data = $account->select_data($mail_data->account_id);

        $mail_data->account_name = $account_data->name;
        $mail_data->email = $account_data->email;

        return view('admin.mail.detail', compact('mail_data'));
    }

    //メール送信作成画面
    public function mail_create($id)
    {
        $account = new Accounts();
        $account_data = $account->select_data($id);

        $template = new MailTemplate();
        $template_data = $template->select_data_use_input();

        $data = [];
        $data['account_id'] = $account_data->id;
        $data['email'] = $account_data->email;
        $data['account_name'] = $account_data->name;
        $data['adress'] = $data['email'] . ' ( ' . $data['account_name'] . ' )';
        $data['title'] = '';
        $data['content'] = '';

        return view('admin.mail.create.index', compact('data', 'template_data'));
    }


    //メール送信作成確認画面
    public function mail_create_confirm(Request $request)
    {

        $data = [];
        $data['account_id'] = $request->account_id;
        $data['adress'] = $request->adress;
        $data['title'] = $request->title;
        $data['content'] = $request->content;

        return view('admin.mail.create.confirm', compact('data'));
    }

    //メール送信作成画面(修正へ)
    public function mail_create_fix(Request $request)
    {
        $data = [];
        $data['account_id'] = $request->account_id;
        $data['adress'] = $request->adress;
        $data['title'] = $request->title;
        $data['content'] = $request->content;

        return view('admin.mail.create.index', compact('data'));
    }

    //メール送信処理
    public function mail_create_post(Request $request)
    {
        $account = new Accounts();
        $account_data = $account->select_data($request->account_id);


        $account_id = $account_data->id;
        $title = $request->title;
        $content = $request->content;

        $data = [];
        $data['subject'] = $title;
        $data['content'] = $content;
        $data['email'] = $account_data->email;

        //予約者に対してメール
        \Illuminate\Support\Facades\Mail::send(new SendMail($data));

        $mail = new Mail();

        $res = $mail->create([
            'account_id' => $account_id,
            'title' => $title,
            'content' => $content,
        ]);

        if (!empty($res)) {
            $message = 'メール履歴を登録しました';
        } else {
            $message = 'メール履歴登録に失敗しました';
        }

        return redirect('admin/mail')->with('message', $message);
    }





    //
    // ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊テンプレート＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊
    //

    //初期表示画面(メールアドレス検索)
    public function mail_template()
    {
        $mail_template = new MailTemplate();
        $template_data = $mail_template->get_data_all();

        return view('admin.mail.template.index', compact('template_data'));
    }

    //メールテンプレート作成画面
    public function mail_template_create()
    {

        $data = [];
        $data['method'] = '';
        $data['title'] = '';
        $data['content'] = '';

        return view('admin.mail.template.create', compact('data'));
    }

    //メールテンプレート作成画面
    public function mail_template_confirm(Request $request)
    {

        $data = [];
        $data['method'] = $request->method;
        $data['title'] = $request->title;
        $data['content'] = $request->content;

        return view('admin.mail.template.confirm', compact('data'));
    }

    //メールテンプレート作成画面(修正)
    public function mail_template_confirm_post(Request $request)
    {

        $data = [];
        $data['method'] = $request->method;
        $data['title'] = $request->title;
        $data['content'] = $request->content;

        return view('admin.mail.template.create', compact('data'));
    }

    //メールテンプレート作成処理
    public function mail_template_create_post(Request $request)
    {

        $mail_template = new MailTemplate();

        $res = $mail_template->create([
            'method' => $request->method,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        if (!empty($res)) {
            $message = '新規テンプレートを登録しました';
        } else {
            $message = '新規テンプレートに失敗しました';
        }
        return redirect('/admin/mail/template')->with('message', $message);
    }

    //メールテンプレート詳細表示
    public function mail_template_detail_confirm($id)
    {
        $mail_template = new MailTemplate();
        $template_data = $mail_template->select_data($id);

        $tmp_created_at = new DateTime($template_data->created_at);
        $template_data->created_at = $tmp_created_at->format('n月j日 G:i');

        return view('admin.mail.template.detail', compact('template_data'));
    }

    //メールテンプレート詳細表示
    public function mail_template_detail($id)
    {
        $mail_template = new MailTemplate();
        $template_data_list = $mail_template->select_data($id);

        $template_data = [];
        $template_data['id'] = $template_data_list->id;
        $template_data['method'] = $template_data_list->method;
        $template_data['title'] = $template_data_list->title;
        $template_data['content'] = $template_data_list->content;
        $template_data['input_flg'] = $template_data_list->input_flg;

        return view('admin.mail.template.detail_fix', compact('template_data'));
    }


    //メールテンプレート編集画面
    public function mail_template_detail_confirm_post(Request $request)
    {
        $template_data = [];
        $template_data['id'] = $request->id;
        $template_data['method'] = $request->method;
        $template_data['title'] = $request->title;
        $template_data['content'] = $request->content;
        $template_data['input_flg'] = $request->input_flg;

        return view('admin.mail.template.detail_confirm', compact('template_data'));
    }

    //メールテンプレート編集画面
    public function mail_template_detail_fix_post(Request $request)
    {
        $template_data = [];
        $template_data['id'] = $request->id;
        $template_data['method'] = $request->method;
        $template_data['title'] = $request->title;
        $template_data['content'] = $request->content;
        $template_data['input_flg'] = $request->input_flg;

        return view('admin.mail.template.detail_fix', compact('template_data'));
    }

    //メールテンプレート編集処理
    public function mail_template_detail_change_post(Request $request)
    {
        $template_data = [];
        $template_data['id'] = $request->id;
        $template_data['method'] = $request->method;
        $template_data['title'] = $request->title;
        $template_data['content'] = $request->content;
        $template_data['input_flg'] = $request->input_flg;

        $mail_template = new MailTemplate();

        $res = $mail_template->update_detail($template_data);

        $message = $res['message'];

        return redirect('/admin/mail/template/' . $request->id)->with('message', $message);
    }


    //メールテンプレート編集処理
    public function mail_template_input(Request $request)
    {
        $method = $request->template;
        $account_id = $request->account_id;

        $account = new Accounts();
        $account_data = $account->select_data($account_id);

        $mail_template = new MailTemplate();
        $mail_template_data = $mail_template->select_data_from_method($method);

        $search_arr  = ["{{氏名}}", "{{メールアドレス}}"];
        $replace_arr = [$account_data->name, $account_data->email];
        $mail_template_data->content  = str_replace($search_arr, $replace_arr, $mail_template_data->content);

        return $mail_template_data;
    }
    //メールテンプレート編集処理
    public function mail_template_delete($id)
    {
        $mail_template = new MailTemplate();
        $res = $mail_template->where('id', $id)->delete();

        if ($res) {
            $message = 'テンプレートを削除にしました';
        } else {
            $message = 'テンプレートを削除に失敗しました';
        }


        return redirect('/admin/mail/template')->with('message', $message);
    }
}
