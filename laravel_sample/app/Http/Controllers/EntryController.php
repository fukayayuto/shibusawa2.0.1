<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountShibu;
use App\Accounts;
use App\ReserveType;
use App\Reserve;
use App\Entry;
use App\EntryShibu;
use DateTime;
use Alert;

class EntryController extends Controller
{
    //エントリー詳細画面
    public function entry_detail($id)
    {
        $entry = new Entry();
        $entry_data = $entry->select_data($id);

        $entry_data->count = $entry_data->count_1 + $entry_data->count_2 + $entry_data->count_3;

        $reserve = new Reserve();
        $reserve_data = $reserve->select_data_from_reserve_id($entry_data->reserve_id);

        $reserve_type = new ReserveType();
        $reserve_type_data = $reserve_type->get_data_select($reserve_data->type);
        $reserve_data->reserve_name = $reserve_type_data->name;

        $entry_data->price = $reserve_type_data->price;

        if (!empty($entry_data->payment_date)) {
            $payment_date = new DateTime($entry_data->payment_date);
            $entry_data->payment_date = $payment_date->format('Y年n月j日 G:i');
        }

        $tmp_start_date = new DateTime($reserve_data->start_date);
        $reserve_data->start_date = $tmp_start_date->format('Y年n月j日');

        $account = new Accounts();
        $account_data = $account->select_data($entry_data->account_id);


        return view('admin.entry.detail', compact('reserve_data', 'entry_data', 'account_data'));
    }

    //エントリー日時変更
    public function change_start_date($id)
    {
        $entry = new Entry();
        $entry_data = $entry->select_data($id);

        $start_date = new DateTime($entry_data->start_date);
        $entry_data->start_date = $start_date->format('Y年n月j日');

        return view('admin.entry.change_start_date', compact('entry_data'));
    }

    //エントリー日時変更後
    public function change_start_date_post(Request $request)
    {
        $data['id'] = $request->id;
        $data['start_date'] = $request->start_date;
        $data['start_time'] = $request->start_time_1 . ':' . $request->start_time_2;

        $entry = new Entry();
        $res = $entry->update_start_date($data);
        $message = $res['message'];

        return redirect('/admin/entry/detail/' . $request->id)->with('message', $message);
    }

    //エントリー人数変更
    public function change_count($id)
    {
        $entry = new Entry();
        $entry_data = $entry->select_data($id);

        $entry_data->count = $entry_data->count_1 + $entry_data->count_2 + $entry_data->count_3;

        return view('admin.entry.change_count', compact('entry_data'));
    }

    //エントリー人数変更後
    public function change_count_post(Request $request)
    {
        $data['id'] = $request->id;
        $data['count_1'] = $request->count_1;
        $data['count_2'] = $request->count_2;
        $data['count_3'] = $request->count_3;

        $entry = new Entry();
        $res = $entry->update_count($data);
        $message = $res['message'];

        return redirect('/admin/entry/detail/' . $request->id)->with('message', $message);
    }

    //エントリーステータス変更
    public function change_status($id)
    {
        $entry = new Entry();
        $entry_data = $entry->select_data($id);

        return view('admin.entry.change_status', compact('entry_data'));
    }

    //エントリーステータス変更後
    public function change_status_post(Request $request)
    {
        $data['id'] = $request->id;
        $data['status'] = $request->status;

        $entry = new Entry();
        $res = $entry->update_status($data);
        $message = $res['message'];

        return redirect('/admin/entry/detail/' . $request->id)->with('message', $message);
    }

    //入金登録画面
    public function entry_payment($id)
    {
        $entry = new Entry();
        $entry_data = $entry->select_data($id);

        $reserve = new Reserve();
        $reserve_data = $reserve->select_data_from_reserve_id($entry_data->reserve_id);

        $reserve_type = new ReserveType();
        $reserve_type_data = $reserve_type->get_data_select($reserve_data->type);

        $entry_data->price = $reserve_type_data->price;

        return view('admin.entry.payment', compact('entry_data'));
    }

    //入金登録処理
    public function entry_payment_post(Request $request)
    {
        $data['id'] = $request->id;
        $old_payment = $request->old_payment;
        $data['payment'] = $request->payment + $old_payment;

        $entry = new Entry();
        $res = $entry->payment_store($data);
        $message = $res['message'];

        return redirect('/admin/entry/detail/' . $request->id)->with('message', $message);
    }


    //エントリー一覧表示(予約種別ごとに)
    public function entry_list_reserve_type($type)
    {
        $entry = new Entry();
        $entry_data_list = $entry->get_data_all();
        $entry_data = [];

        foreach ($entry_data_list as $k => $val) {
            $reserve = new Reserve();
            $reserve_data = $reserve->select_data_from_reserve_id($val->reserve_id);

            //予約種別が異なるものは排除
            if ($reserve_data->type != $type) {
                continue;
            }

            $tmp = [];
            $tmp['id'] = $val->id;

            $tmp_start_date = new DateTime($reserve_data->start_date);
            $tmp['start_date'] = $tmp_start_date->format('n月j日');

            if (!empty($reserve_data->start_time)) {
                $tmp['start_date'] .= ' ' . $reserve_data->start_time;
            }
            $tmp['count_1'] = $val->count_1;
            $tmp['count_2'] = $val->count_2;
            $tmp['count_3'] = $val->count_3;
            $tmp['count'] = $tmp['count_1'] + $tmp['count_2'] + $tmp['count_3'];
            $tmp['status'] = $val->status;

            $tmp_created_at = new DateTime($val->created_at);
            $tmp['created_at'] = $tmp_created_at->format('n月j日 G:i');

            $account = new Accounts();
            $account_data = $account->select_data($val->account_id);
            $tmp['name'] = $account_data->name;
            $tmp['pref'] = $account_data->pref;

            $entry_data[$k] = $tmp;
        }

        $reserve_type = new ReserveType();
        $reserve_type_data = $reserve_type->get_data_select($type);

        return view('admin.entry.list.type', compact('entry_data', 'reserve_type_data'));
    }



    //カレンダー表示データ
    public function set_data($type)
    {
        $reserve_data = [];
        $reserve = new Reserve();
        $reserve_data_list = $reserve->get_data($type);

        foreach ($reserve_data_list as $k => $val) {


            $tmp = [];

            $tmp['start'] = $val->start_date;

            $enrty = new Entry();
            $entry_data_list = $enrty->select_data_from_revervation_id($val->id);
            $left_seat = $val->count;
            $entry_count = 0;

            foreach ($entry_data_list as $value) {
                if ($value->status != 2) {
                    $left_seat--;
                    $entry_count++;
                }
            }

            $tmp['title'] = $val->start_time . ' ( ' . $left_seat . ' / ' . $val->count . ' )';
            $tmp['color'] = '#00FF7F';
            $tmp['url'] = '/reserve/detail/' . $val->id;

            if ($entry_count > 0) {
                $tmp['color'] = '#FF4500';
            }

            if ($left_seat > 0) {
            } else {
                $tmp['color'] = '#FF4500';
                $tmp['title'] .= ' 定員満員';
            }

            if ($val->display_flg == 1) {
                $tmp['color'] = '#A9A9A9';
                $tmp['title'] .= ' 受付中止';
            }
            $tmp['textColor'] = 'black';

            $data[$k] = $tmp;
        }

        return $data;
    }

    //カレンダー表示データ
    public function reschedule_set_data($type, $id)
    {
        $reserve_data = [];
        $reserve = new Reserve();
        $reserve_data_list = $reserve->get_data($type);

        foreach ($reserve_data_list as $k => $val) {

            $tmp = [];

            $tmp['start'] = $val->start_date;

            $enrty = new Entry();
            $entry_data_list = $enrty->select_data_from_revervation_id($val->id);
            $left_seat = $val->count;

            foreach ($entry_data_list as $value) {
                if ($value->status != 2) {
                    $left_seat--;
                }
            }

            $tmp['title'] = $val->start_time . ' ( ' . $left_seat . ' / ' . $val->count . ' )';
            $tmp['color'] = '#00FF7F';


            if ($left_seat > 0) {
                $tmp['url'] = '/entry/reschedule/confirm/' . $val->id . '/' . $id;
            } else {
                $tmp['color'] = '#FF4500';
                $tmp['title'] .= ' 定員満員';
            }

            if ($val->display_flg == 1) {
                $tmp['color'] = '#A9A9A9';
                $tmp['title'] .= ' 受付中止';
            }
            $tmp['textColor'] = 'black';

            $data[$k] = $tmp;
        }

        return $data;
    }

    //エントリー一覧表示(予約種別ごとに)
    public function reschedule_confirm($new_id, $id)
    {
        $entry = new Entry();
        $entry_data = $entry->select_data($id);

        $reserve = new Reserve();
        $reserve_data = $reserve->select_data_from_reserve_id($entry_data->reserve_id);

        $tmp_start_date = new DateTime($reserve_data->start_date);
        $reserve_data->start_date = $tmp_start_date->format('Y年n月j日');

        if (!empty($reserve_data->start_time)) {
            $reserve_data->start_date .= ' ' . $reserve_data->start_time;
        }

        $reserve_type = new ReserveType();
        $reserve_type_data = $reserve_type->get_data_select($reserve_data->type);

        $reserve = new Reserve();
        $new_reserve_data = $reserve->select_data_from_reserve_id($new_id);

        $tmp_new_start_date = new DateTime($new_reserve_data->start_date);
        $new_reserve_data->start_date = $tmp_new_start_date->format('Y年n月j日');

        if (!empty($new_reserve_data->start_time)) {
            $new_reserve_data->start_date .= ' ' . $new_reserve_data->start_time;
        }

        return view('admin.entry.reschedule.confirm', compact('reserve_type_data', 'reserve_data', 'new_reserve_data'))->with('entry_id', $id);
    }

    //エントリー日時変更後
    public function entry_rechedule(Request $request)
    {
        $data['id'] = $request->entry_id;
        $data['reserve_id'] = $request->new_id;

        $entry = new Entry();
        $res = $entry->reschedule($data);
        $message = $res['message'];

        return redirect('/admin/entry/detail/' . $request->entry_id)->with('message', $message);
    }


    //エントリー一覧表示(予約種別ごとに)
    public function entry_calendar_list($type)
    {
        $entry = new Entry();
        $entry_data_list = $entry->get_data_all();
        $entry_data = [];

        foreach ($entry_data_list as $k => $val) {
            $reserve = new Reserve();
            $reserve_data = $reserve->select_data_from_reserve_id($val->reserve_id);

            //予約種別が異なるものは排除
            if ($reserve_data->type != $type) {
                continue;
            }

            if ($val->status != 0) {
                continue;
            }

            $tmp = [];
            $tmp['id'] = $val->id;

            $tmp_start_date = new DateTime($reserve_data->start_date);
            $tmp['start_date'] = $tmp_start_date->format('n月j日');

            if (!empty($reserve_data->start_time)) {
                $tmp['start_date'] .= ' ' . $reserve_data->start_time;
            }
            $tmp['count_1'] = $val->count_1;
            $tmp['count_2'] = $val->count_2;
            $tmp['count_3'] = $val->count_3;
            $tmp['count'] = $tmp['count_1'] + $tmp['count_2'] + $tmp['count_3'];
            $tmp['status'] = $val->status;

            $tmp_created_at = new DateTime($val->created_at);
            $tmp['created_at'] = $tmp_created_at->format('n月j日 G:i');

            $account = new Accounts();
            $account_data = $account->select_data($val->account_id);
            $tmp['name'] = $account_data->name;
            $tmp['pref'] = $account_data->pref;

            $entry_data[$k] = $tmp;
        }

        $reserve_type = new ReserveType();
        $reserve_type_data = $reserve_type->get_data_select($type);

        return view('admin.entry.calendar.index', compact('reserve_type_data', 'entry_data'));
    }

    //エントリー一覧表示(予約種別ごとに)
    public function entry_reschedule($id)
    {
        $entry = new Entry();
        $enrty_data = $entry->select_data($id);

        $reserve = new Reserve();
        $reserve_data = $reserve->select_data_from_reserve_id($enrty_data->reserve_id);

        $reserve_type = new ReserveType();
        $reserve_type_data = $reserve_type->get_data_select($reserve_data->type);

        return view('admin.entry.reschedule.index', compact('reserve_type_data'))->with('entry_id', $id);
    }

    //新規申し込み画面
    public function entry_create($id)
    {
        $reserve = new Reserve();
        $reserve_data = $reserve->select_data_from_reserve_id($id);

        $reserve_type = new ReserveType();
        $reserve_type_data = $reserve_type->get_data_select($reserve_data->type);
        $reserve_data->name = $reserve_type_data->name;

        $tmp_start_date = new DateTime($reserve_data->start_date);
        $reserve_data->start_date = $tmp_start_date->format('Y年n月j日');

        if (!empty($reserve_data->start_time)) {
            $reserve_data->start_date .= ' ' . $reserve_data->start_time;
        }

        $data = [];
        $data['id'] = '';
        $data['reserve_name'] = '';
        $data['start_date'] = '';
        $data['count_1'] = '';
        $data['count_2'] = '';
        $data['count_3'] = '';
        $data['name'] = '';
        $data['name_kana'] = '';
        $data['email'] = '';
        $data['phone'] = '';
        $data['pref'] = '';
        $data['adress'] = '';
        $data['pay_method'] = '';
        $data['adult_check'] = '';


        return view('admin.entry.create.index', compact('reserve_data', 'reserve_type_data', 'data'));
    }

    //新規申し込み確認画面
    public function entry_create_confirm_post(Request $request)
    {
        $data = [];
        $data['id'] = $request->id;
        $data['reserve_name'] = $request->reserve_name;
        $data['start_date'] = $request->start_date;
        $data['count_1'] = $request->count_1;
        $data['count_2'] = $request->count_2;
        $data['count_3'] = $request->count_3;
        $data['name'] = $request->name;
        $data['name_kana'] = $request->name_kana;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['pref'] = $request->pref;
        $data['adress'] = $request->adress;
        $data['pay_method'] = $request->pay_method;
        $data['adult_check'] = $request->adult_check;

        return view('admin.entry.create.confirm', compact('data'));
    }

    //新規申し込み修正へ
    public function entry_create_fix(Request $request)
    {
        $data = [];
        $data['id'] = $request->id;
        $data['reserve_name'] = $request->reserve_name;
        $data['start_date'] = $request->start_date;
        $data['count_1'] = $request->count_1;
        $data['count_2'] = $request->count_2;
        $data['count_3'] = $request->count_3;
        $data['name'] = $request->name;
        $data['name_kana'] = $request->name_kana;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['pref'] = $request->pref;
        $data['adress'] = $request->adress;
        $data['pay_method'] = $request->pay_method;
        $data['adult_check'] = $request->adult_check;

        $reserve = new Reserve();
        $reserve_data = $reserve->select_data_from_reserve_id($request->id);

        $reserve_type = new ReserveType();
        $reserve_type_data = $reserve_type->get_data_select($reserve_data->type);

        $reserve_data->id = $request->id;
        $reserve_data->name = $request->reserve_name;
        $reserve_data->start_date =  $request->start_date;

        return view('admin.entry.create.index', compact('data', 'reserve_type_data', 'reserve_data'));
    }

    //新規申し込み処理
    public function entry_create_post(Request $request)
    {
        $data = [];
        $data['id'] = $request->id;
        $data['reserve_name'] = $request->reserve_name;
        $data['start_date'] = $request->start_date;
        $data['count_1'] = $request->count_1;
        $data['count_2'] = $request->count_2;
        $data['count_3'] = $request->count_3;
        $data['pay_method'] = $request->pay_method;
        $data['adult_check'] = $request->adult_check;

        $account = new Accounts();

        $insert_data = $account->create([
            'name' => $request->name,
            'name_kana' => $request->name_kana,
            'email' => $request->email,
            'phone' => $request->phone,
            'pref' => $request->pref,
            'adress' => $request->adress,
        ]);
        $account_id = $insert_data->id;

        $entry = new Entry();

        $res = $entry->create([
            'account_id' => $account_id,
            'pay_method' => $request->pay_method,
            'reserve_id' => $request->id,
            'count_1' => $request->count_1,
            'count_2' => $request->count_2,
            'count_3' => $request->count_3,
            'adult_check' => $request->adult_check,
        ]);

        if (!empty($res)) {
            $message = '新規予約を登録しました';
        } else {
            $message = '新規予約を登録に失敗しました';
        }



        return redirect('/admin/entry/detail/' . $request->id)->with('message', $message);
    }
}
