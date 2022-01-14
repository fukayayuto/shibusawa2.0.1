<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accounts;
use DateTime;
use App\EntryShibu;
use App\Entry;
use App\ReserveType;
use App\Reserve;

class AccountsController extends Controller
{
    //初期表示画面
    public function index()
    {
        $accounts = new Accounts();
        $account_data = $accounts->get_data_lastest();

        return view('admin.account.index', compact('account_data'));
    }

    //詳細表示
    public function detail($id)
    {
        $accounts = new Accounts();
        $account_data = $accounts->select_data($id);

        $created_at = new DateTime($account_data->created_at);
        $account_data->created_at = $created_at->format('Y年n月j日 G:i');

        $updated_at = new DateTime($account_data->updated_at);
        $account_data->updated_at = $created_at->format('Y年n月j日 G:i');

        //渋沢用エントリー
        $entry_shibu = new EntryShibu();
        $tmp_entry_data = $entry_shibu->select_data_from_account($account_data->id);
        $shibusawa_entry_data = [];

        if (!empty($tmp_entry_data)) {

            $reserve_type = new ReserveType();
            $type = 2631;
            $reserve_data = $reserve_type->get_data_select($type);

            foreach ($tmp_entry_data as $k => $val) {
                $tmp = [];
                $tmp['id'] = $val['id'];
                $tmp['reserve_name'] = $reserve_data->name;
                $tmp['start_date'] = $val->start_date;
                if (!empty($val->start_time)) {
                    $tmp['start_date'] .= ' ' .  $val->start_time;
                }
                $shibusawa_entry_data[$k] = $tmp;
            }
        }

        //エントリー取得
        $entry = new Entry();
        $tmp_entry_data = $entry->select_data_from_account($account_data->id);
        $entry_data = [];

        if (!empty($tmp_entry_data)) {

            foreach ($tmp_entry_data as $t => $value) {
                $tmp = [];
                $tmp['id'] = $value['id'];

                $reserve = new Reserve();
                $reserve_data = $reserve->select_data_from_reserve_id($value['reserve_id']);

                $reserve_type = new ReserveType();
                $reserve_type_data = $reserve_type->get_data_select($reserve_data->type);

                $tmp['reserve_name'] = $reserve_type_data->name;

                $tmp['start_date'] = $reserve_data->start_date;
                if (!empty($reserve_data->start_time)) {
                    $tmp['start_date'] .= ' ' .  $reserve_data->start_time;
                }
                $entry_data[$t] = $tmp;
            }
        }


        return view('admin.account.detail', compact('account_data', 'entry_data', 'shibusawa_entry_data'));
    }

    //初期表示画面
    public function edit($id)
    {
        $accounts = new Accounts();
        $account_data = $accounts->select_data($id);

        return view('admin.account.edit', compact('account_data'));
    }



    //詳細表示
    public function change(Request $request)
    {
        $data = [];
        $data['id'] = $request->id;
        $data['name'] = $request->name;
        $data['name_kana'] = $request->name_kana;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['pref'] = $request->pref;
        $data['adress'] = $request->adress;

        $accounts = new Accounts();
        $res = $accounts->update_account($data);
        $message = $res['message'];

        return redirect('admin/account/detail/' . $request->id)->with('message', $message);
    }
}
