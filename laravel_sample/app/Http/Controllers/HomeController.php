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

class HomeController extends Controller
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
    public function index()
    {
        $entry = new Entry();
        $entry_data_list = $entry->get_data_all();
        $entry_data = [];

        foreach ($entry_data_list as $k => $val) {
            $reserve = new Reserve();
            $reserve_data = $reserve->select_data_from_reserve_id($val->reserve_id);

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

            $reserve_type = new ReserveType();
            $reserve_type_data = $reserve_type->get_data_select($reserve_data->type);
            $reserve_name = $reserve_type_data->name;

            $tmp['reserve_name'] = mb_substr($reserve_name, 0, 15);

            $entry_data[$k] = $tmp;
        }

        $entryShibu = new EntryShibu();
        $shibusawa_entry_data_list = $entryShibu->get_data_all();

        $shibusawa_entry_data = [];

        foreach ($shibusawa_entry_data_list as $k => $value) {

            if ($value->status != 0) {
                continue;
            }
            $tmp = [];
            $tmp['id'] = $value->id;

            $created_at = new DateTime($value->created_at);
            $tmp['created_at'] = $created_at->format('n月j日 G:i');

            $tmp['count_1'] = $value->count_1;
            $tmp['count_2'] = $value->count_2;
            $tmp['count_3'] = $value->count_3;

            $tmp['count'] = $tmp['count_1'] + $tmp['count_2'] + $tmp['count_3'];

            $start_date = new DateTime($value->start_date);
            $tmp['start_date'] = $start_date->format('n月j日');

            $tmp['start_time'] = $value->start_time;

            $account = new Accounts();
            $account_data = $account->select_data($value->account_id);
            $tmp['name'] = $account_data->name;
            $tmp['pref'] = $account_data->pref;

            $tmp['start_station'] = $value->start_station;
            $tmp['finish_station'] = $value->finish_station;
            $tmp['status'] = $value->status;

            $reserve_type = new ReserveType();
            $type = 2631;
            $reserve_type_data = $reserve_type->get_data_select($type);
            $reserve_name = $reserve_type_data->name;

            $tmp['reserve_name'] = mb_substr($reserve_name, 0, 15);

            $shibusawa_entry_data[$k] = $tmp;
        }

        return view('admin.home', compact('entry_data', 'shibusawa_entry_data'));
    }
}
