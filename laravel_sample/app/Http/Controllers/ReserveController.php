<?php

namespace App\Http\Controllers;

use App\AccountShibu;
use App\Accounts;
use Illuminate\Http\Request;
use App\ReserveType;
use App\Reserve;
use App\Entry;
use App\EntryShibu;
use DateTime;
use Alert;
use Illuminate\Support\Facades\Cookie;

class ReserveController extends Controller
{
    //初期表示画面
    public function index()
    {
        $reserve_type = new ReserveType();
        $reserve_type_data = $reserve_type->get_data_all();

        return view('admin.reserve.index', compact('reserve_type_data'));
    }

    //予約リストを表示
    public function list($id)
    {
        $reserve_type = new ReserveType();
        $reserve_type_data = $reserve_type->get_data_select($id);
        $reserve_name = $reserve_type_data->name;
        $reserve_id = $reserve_type_data->id;


        if ($id == 2631) {
            $entry = new EntryShibu();
            $entry_data = $entry->get_data_lastest();

            $data = [];

            foreach ($entry_data as $k => $val) {
                $tmp = [];
                $tmp['id'] = $val->id;

                $created_at = new DateTime($val->created_at);
                $tmp['created_at'] = $created_at->format('n月j日 G:i');

                $tmp['count_1'] = $val->count_1;
                $tmp['count_2'] = $val->count_2;
                $tmp['count_3'] = $val->count_3;

                $tmp['count'] = $tmp['count_1'] + $tmp['count_2'] + $tmp['count_3'];

                $start_date = new DateTime($val->start_date);
                $tmp['start_date'] = $start_date->format('n月j日');

                $week = array("日", "月", "火", "水", "木", "金", "土");
                $start_week = $week[$start_date->format("w")];

                $tmp['start_date'] .=  '(' . $start_week . ')';

                $tmp['start_time'] = $val->start_time;

                $tmp['start_station'] = $val->start_station;
                $tmp['finish_station'] = $val->finish_station;
                $tmp['status'] = $val->status;

                $data[$k] = $tmp;
            }

            return view('admin.reserve.entry.shibusawa', compact('data'))->with('reserve_name', $reserve_name);
        }

        $reserve = new Reserve();
        $tmp_reserve_data = $reserve->get_data_recently($id);
        $reserve_data = [];
        foreach ($tmp_reserve_data as $k => $item) {
            $tmp = [];
            $tmp['id'] = $item['id'];
            $tmp['entry_count'] = 0;
            $tmp_start_date = new DateTime($item->start_date);
            $tmp['start_date'] = $tmp_start_date->format('n月j日');
            $tmp['start_time'] = '';
            if (!empty($item->start_time)) {
                $tmp['start_time'] = $item->start_time;
            }
            $tmp['display_flg'] = $item->display_flg;
            $tmp['count'] = $item->count;
            $tmp['entry_color'] = 'light';

            $entry = new Entry();
            $entry_data = $entry->select_data_from_revervation_id($item->id);

            if (!$entry_data->isEmpty()) {
                foreach ($entry_data as $value) {
                    if ($value['status'] == 2) {
                        continue;
                    }
                    if (($value->count_1 + $value->count_2 + $value->count_3) > 0) {
                        $tmp['entry_count'] = 1;
                        $tmp['entry_color'] = 'success';
                    }
                }
            }

            if ($item->display_flg == 1) {
                $tmp['entry_color'] = 'secondary';
            }

            $reserve_data[$k] = $tmp;
        }

        return view('admin.reserve.list', compact('reserve_data'))->with('reserve_name', $reserve_name)->with('reserve_id', $reserve_id);
    }


    //予約用エントリー詳細
    public function reserve_detail($id)
    {
        $reserve = new Reserve();
        $reserve_data = $reserve->select_data_from_reserve_id($id);

        $reserve_type = new ReserveType();
        $reserve_type_data = $reserve_type->get_data_select($reserve_data->type);
        $reserve_name = $reserve_type_data->name;


        $tmp_start_date = new DateTime($reserve_data->start_date);
        $reserve_data->start_date = $tmp_start_date->format('n月j日');

        $week = array("日", "月", "火", "水", "木", "金", "土");
        $start_week = $week[$tmp_start_date->format("w")];

        $reserve_data->start_date .= '(' . $start_week . ')';

        $data = [];
        $count = $reserve_data->count;

        $entry = new Entry();
        $entry_data = $entry->select_data_from_revervation_id($reserve_data->id);

        if (!$entry_data->isEmpty()) {
            foreach ($entry_data as $k => $value) {
                $tmp = [];
                $tmp['id'] = $value->id;
                $tmp['status'] = $value->status;
                $tmp['count'] = $value->count_1 + $value->count_2 + $value->count_3;
                $tmp['count_1'] = $value->count_1;
                $tmp['count_2'] = $value->count_2;
                $tmp['count_3'] = $value->count_3;
                $tmp_created_at = new DateTime($value->created_at);
                $tmp['created_at']  = $tmp_created_at->format('n月j日 G:i');

                $account = new Accounts();
                $account_data = $account->select_data($value->account_id);
                $tmp['name'] = $account_data->name;
                $tmp['name_kana'] = $account_data->name_kana;
                $tmp['pref'] = $account_data->pref;

                if ($tmp['status'] != 2) {
                    $count--;
                }

                $data[$k] = $tmp;
            }
        }

        $reserve_data->left_seat = $count;



        return view('admin.reserve.detail', compact('reserve_data', 'data'))->with('reserve_name', $reserve_name);
    }

    //予約受付状態の変更画面
    public function display_flg($id)
    {
        $reserve = new Reserve();
        $reserve_data = $reserve->select_data_from_reserve_id($id);

        return view('admin.reserve.display_flg', compact('reserve_data'));
    }

    //予約受付状態の変更画面
    public function display_flg_post(Request $request)
    {
        $reserve_id = $request->id;
        $display_flg = $request->display_flg;

        $reserve = new Reserve();
        $res = $reserve->update_display_flg($reserve_id, $display_flg);
        $message = $res['message'];

        return redirect('/admin/reserve/detail/' . $reserve_id)->with('message', $message);
    }

    //予約受付状態の変更画面
    public function count($id)
    {
        $reserve = new Reserve();
        $reserve_data = $reserve->select_data_from_reserve_id($id);

        return view('admin.reserve.count', compact('reserve_data'));
    }

    //予約受付状態の変更画面
    public function reserve_count_post(Request $request)
    {
        $reserve_id = $request->id;
        $count = $request->count;

        $reserve = new Reserve();
        $res = $reserve->update_count($reserve_id, $count);
        $message = $res['message'];

        return redirect('/admin/reserve/detail/' . $reserve_id)->with('message', $message);
    }


    //予約受付状態の変更画面
    public function calendar()
    {
        $type = 1294;

        $reserve = new Reserve();
        $reserve_data = $reserve->get_data($type);

        return view('admin.reserve.display_flg', compact('reserve_data'));
    }






    //渋沢用エントリー詳細
    public function shibusawa_entry($id)
    {

        $data = Cookie::get('key');

        var_dump($data);
        die();

        $entry = new EntryShibu();
        $entry_data = $entry->select_data($id);

        $created_at = new DateTime($entry_data->created_at);
        $entry_data->created_at = $created_at->format('Y年n月j日');

        $entry_data->count = $entry_data->count_1 + $entry_data->count_2 + $entry_data->count_3;

        $start_date = new DateTime($entry_data->start_date);
        $entry_data->start_date = $start_date->format('Y年n月j日');


        $week = array("日", "月", "火", "水", "木", "金", "土");
        $start_week = $week[$start_date->format("w")];

        $entry_data->start_date .= '(' . $start_week . ')';

        if (!empty($entry_data->payment_date)) {
            $payment_date = new DateTime($entry_data->payment_date);
            $entry_data->payment_date = $payment_date->format('Y年n月j日 G:i');
        }

        $reserve_type = new ReserveType();
        $type = 2631;
        $reserve_type_data = $reserve_type->get_data_select($type);

        $entry_data->price = $reserve_type_data->price;

        $account = new Accounts();
        $account_data = $account->select_data($entry_data->account_id);

        return view('admin.reserve.entry.shibusawa_detail', compact('entry_data', 'account_data'));
    }

    //渋沢用入金登録
    public function shibusawa_payment($id)
    {
        $entry = new EntryShibu();
        $entry_data = $entry->select_data($id);

        $reserve_type = new ReserveType();
        $type = 2631;
        $reserve_type_data = $reserve_type->get_data_select($type);

        $entry_data->price = $reserve_type_data->price;

        return view('admin.reserve.entry.shibusawa.payment', compact('entry_data'));
    }

    //渋沢用入金登録後
    public function shibusawa_payment_post(Request $request)
    {
        $data['id'] = $request->id;
        $old_payment = $request->old_payment;
        $data['payment'] = $request->payment + $old_payment;

        $entry = new EntryShibu();
        $res = $entry->payment_store($data);
        $message = $res['message'];

        return redirect('/admin/entry/shibusawa/' . $request->id)->with('message', $message);
    }

    //渋沢用エントリー日時変更
    public function shibusawa_change_start_date($id)
    {
        $entry = new EntryShibu();
        $entry_data = $entry->select_data($id);

        $start_date = new DateTime($entry_data->start_date);
        $entry_data->start_date = $start_date->format('Y年n月j日');

        return view('admin.reserve.entry.shibusawa.change_start_date', compact('entry_data'));
    }

    //渋沢用エントリー日時変更後
    public function shibusawa_change_start_date_post(Request $request)
    {
        $data['id'] = $request->id;
        $data['start_date'] = $request->start_date;
        $data['start_time'] = $request->start_time_1 . ':' . $request->start_time_2;

        $entry = new EntryShibu();
        $res = $entry->update_start_date($data);
        $message = $res['message'];

        return redirect('/admin/entry/shibusawa/' . $request->id)->with('message',$message);
    }

    //渋沢用エントリー人数変更
    public function shibusawa_change_count($id)
    {
        $entry = new EntryShibu();
        $entry_data = $entry->select_data($id);

        $entry_data->count = $entry_data->count_1 + $entry_data->count_2 + $entry_data->count_3;

       
        return view('admin.reserve.entry.shibusawa.change_count', compact('entry_data'));
    }

    //渋沢用エントリー人数変更後
    public function shibusawa_change_count_post(Request $request)
    {
        $data['id'] = $request->id;
        $data['count_1'] = $request->count_1;
        $data['count_2'] = $request->count_2;
        $data['count_3'] = $request->count_3;

        $entry = new EntryShibu();
        $res = $entry->update_count($data);
        $message = $res['message'];


        $request->session()->flash('message', $message); 

        return redirect('admin/entry/shibusawa/' . $request->id);
    }

    //渋沢用エントリーステータス変更
    public function shibusawa_change_status($id)
    {
        $entry = new EntryShibu();
        $entry_data = $entry->select_data($id);

        return view('admin.reserve.entry.shibusawa.change_status', compact('entry_data'));
    }

    //渋沢用エントリーステータス変更後
    public function shibusawa_change_status_post(Request $request)
    {
        $data['id'] = $request->id;
        $data['status'] = $request->status;

        $entry = new EntryShibu();
        $res = $entry->update_status($data);
        $message = $res['message'];

        return redirect('/admin/entry/shibusawa/' . $request->id)->with('message', $message);
    }

     //渋沢用エントリー乗車、降車場所変更
     public function shibusawa_change_pickup($id)
     {
         $entry = new EntryShibu();
         $entry_data = $entry->select_data($id);
 
         return view('admin.reserve.entry.shibusawa.change_pickup', compact('entry_data'));
     }

    //渋沢用エントリー乗車、降車場所変更
    public function shibusawa_change_pickup_post(Request $request)
    {
        $data['id'] = $request->id;
        $data['start_station'] = $request->start_station;
        $data['start_place'] = $request->start_place;
        $data['finish_station'] = $request->finish_station;
        $data['finish_place'] = $request->finish_place;

        $entry = new EntryShibu();
        $res = $entry->update_pickup($data);
        $message = $res['message'];

        return redirect('/admin/entry/shibusawa/' . $request->id)->with('message', $message);
    }

    //予約枠作成画面
    public function reserve_list_create($type)
    {
        $reserve_type = new ReserveType();
        $reserve_type_data = $reserve_type->get_data_select($type);

        return view('admin.reserve.list.create.index', compact('reserve_type_data'));
    }

    //予約枠作成処理
    public function reserve_list_create_post(Request $request)
    {
        $reserve = new Reserve();
        $res = $reserve->create([
            'type' => $request->type,
            'count' => $request->count,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time_1 . ':' . $request->start_time_2,
        ]);

        if (!empty($res)) {
            $message = '新規予約枠を登録しました';
        } else {
            $message = '新規予約枠の登録に失敗しました';
        }


        return redirect('/admin/entry/calendar/' . $request->type)->with('message', $message);
    }





    //自動作成
    public function auto_create()
    {
        //登録時だけ外すこと
        die();


        $start = '2022-01-14'; # 開始日時
        $end = '2022-05-30'; # 終了日時

        // dateを使う
        for ($i = $start; $i <= $end; $i = date('Y-m-d', strtotime($i . '+1 day'))) {
            $reserve = new Reserve();
            $reserve->fill([
                'type' => '1294',
                'count' => '1',
                'start_date' => $i,
                'start_time' => '09:00',
            ]);

            $reserve->save();

            $reserve = new Reserve();
            $reserve->fill([
                'type' => '1294',
                'count' => '1',
                'start_date' => $i,
                'start_time' => '12:00',
            ]);

            $reserve->save();

            $reserve = new Reserve();
            $reserve->fill([
                'type' => '1294',
                'count' => '1',
                'start_date' => $i,
                'start_time' => '15:00',
            ]);

            $reserve->save();
        }
    }
}
