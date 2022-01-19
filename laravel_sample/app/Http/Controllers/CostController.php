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

class CostController extends Controller
{
    public function index()
    {

        $month = date('Y-m');
        $pre_month = date('Y-m', strtotime('-1 month'));
        $next_month = date('Y-m', strtotime('+1 month'));

        $first_date = $month . '-1';
        $final_date = $month . '-31';
        
        $entry = new Entry();
        $entry_data = $entry->get_data_status_confirm();
        $data = [];

        foreach ($entry_data as $k => $entry) {

            $reserve = new Reserve();
            $reserve_data = $reserve->select_data_from_reserve_id($entry->reserve_id);

            if(!($reserve_data->start_date >= $first_date && $reserve_data->start_date <= $final_date)){
                continue;
            }

            $tmp = [];
            $tmp['id'] = $entry->id;
            $tmp['payment'] = $entry->payment;
            $tmp['count'] = $entry->count_1 + $entry->count_2 + $entry->count_3;
            $tmp['pay_method'] = $entry->pay_method;

            $tmp['payment_date'] = '';
            if (!empty($entry->payment_date)) {
                $payment_date = new DateTime($entry->payment_date);
                $tmp['payment_date'] = $payment_date->format('Y年n月j日 G:i');
            }


            $start_date = new DateTime($reserve_data->start_date);
            $tmp['start_date'] = $start_date->format('Y年n月j日');

            if (!empty($reserve_data->start_time)) {
                $tmp['start_date'] .= ' ' . $reserve_data->start_time;
            }

            $reserve_type = new ReserveType();
            $reserve_type_data = $reserve_type->get_data_select($reserve_data->type);

            $tmp['reserve_name'] = mb_substr($reserve_type_data->name, 0, 12);
            $tmp['price'] = $reserve_type_data->price;

            $accounts = new Accounts();
            $account_data = $accounts->select_data($entry->account_id);

            $tmp['name'] = $account_data->name;

            $tmp['difference'] = $tmp['payment'] - $tmp['price'];

            if ($tmp['difference'] == 0) {
                $tmp['color'] = 'table-primary';
            } elseif ($tmp['difference'] > 0) {
                $tmp['color'] = 'table-danger';
            } else {
                $tmp['color'] = 'table-warning';
            }


            $data[$k] = $tmp;
        }

        $entry_shibu = new EntryShibu();
        $shibusawa_entry_data = $entry_shibu->get_data_from_status_month($month);
        $shibusawa_data = [];

        foreach ($shibusawa_entry_data as $t => $shibusawa) {
            $tmp = [];
            $tmp['id'] = $shibusawa->id;
            $tmp['payment'] = $shibusawa->payment;
            $tmp['count'] = $shibusawa->count_1 + $shibusawa->count_2 + $shibusawa->count_3;
            $tmp['pay_method'] = $shibusawa->pay_method;

            $tmp['payment_date'] = '';
            if (!empty($shibusawa->payment_date)) {
                $payment_date = new DateTime($shibusawa->payment_date);
                $tmp['payment_date'] = $payment_date->format('Y年n月j日 G:i');
            }

            $start_date = new DateTime($shibusawa->start_date);
            $tmp['start_date'] = $start_date->format('Y年n月j日');

            if (!empty($shibusawa->start_time)) {
                $tmp['start_date'] .= ' ' . $shibusawa->start_time;
            }

            $type = 2631;
            $reserve_type = new ReserveType();
            $reserve_type_data = $reserve_type->get_data_select($type);

            $tmp['reserve_name'] = mb_substr($reserve_type_data->name, 0, 12);
            $tmp['price'] = $reserve_type_data->price;

            $accounts = new Accounts();
            $account_data = $accounts->select_data($shibusawa->account_id);

            $tmp['name'] = $account_data->name;

            $tmp['difference'] = $tmp['payment'] - $tmp['price'];

            if ($tmp['difference'] == 0) {
                $tmp['color'] = 'table-primary';
            } elseif ($tmp['difference'] > 0) {
                $tmp['color'] = 'table-danger';
            } else {
                $tmp['color'] = 'table-warning';
            }


            $shibusawa_data[$t] = $tmp;
        }

        $month = date('Y年m月');

        return view('admin.cost.index', compact('data', 'shibusawa_data'))
            ->with('month', $month)->with('pre_month', $pre_month)->with('next_month', $next_month);
    }

    public function month_index($month)
    {
        $entry = new Entry();
        $entry_data = $entry->get_data_status_confirm();
        $data = [];

        $first_date = $month . '-1';
        $final_date = $month . '-31';

        foreach ($entry_data as $k => $entry) {

            $reserve = new Reserve();
            $reserve_data = $reserve->select_data_from_reserve_id($entry->reserve_id);

            if(!($reserve_data->start_date >= $first_date && $reserve_data->start_date <= $final_date)){
                continue;
            }

            $tmp = [];
            $tmp['id'] = $entry->id;
            $tmp['payment'] = $entry->payment;
            $tmp['count'] = $entry->count_1 + $entry->count_2 + $entry->count_3;
            $tmp['pay_method'] = $entry->pay_method;

            $tmp['payment_date'] = '';
            if (!empty($entry->payment_date)) {
                $payment_date = new DateTime($entry->payment_date);
                $tmp['payment_date'] = $payment_date->format('Y年n月j日 G:i');
            }

            $start_date = new DateTime($reserve_data->start_date);
            $tmp['start_date'] = $start_date->format('Y年n月j日');

            if (!empty($reserve_data->start_time)) {
                $tmp['start_date'] .= ' ' . $reserve_data->start_time;
            }

            $reserve_type = new ReserveType();
            $reserve_type_data = $reserve_type->get_data_select($reserve_data->type);

            $tmp['reserve_name'] = mb_substr($reserve_type_data->name, 0, 12);
            $tmp['price'] = $reserve_type_data->price;

            $accounts = new Accounts();
            $account_data = $accounts->select_data($entry->account_id);

            $tmp['name'] = $account_data->name;

            $tmp['difference'] = $tmp['payment'] - $tmp['price'];

            if ($tmp['difference'] == 0) {
                $tmp['color'] = 'table-primary';
            } elseif ($tmp['difference'] > 0) {
                $tmp['color'] = 'table-danger';
            } else {
                $tmp['color'] = 'table-warning';
            }


            $data[$k] = $tmp;
        }

        $entry_shibu = new EntryShibu();
        $shibusawa_entry_data = $entry_shibu->get_data_from_status_month($month);
      
        $shibusawa_data = [];

        foreach ($shibusawa_entry_data as $t => $shibusawa) {
            $tmp = [];
            $tmp['id'] = $shibusawa->id;
            $tmp['payment'] = $shibusawa->payment;
            $tmp['count'] = $shibusawa->count_1 + $shibusawa->count_2 + $shibusawa->count_3;
            $tmp['pay_method'] = $shibusawa->pay_method;

            $tmp['payment_date'] = '';
            if (!empty($shibusawa->payment_date)) {
                $payment_date = new DateTime($shibusawa->payment_date);
                $tmp['payment_date'] = $payment_date->format('Y年n月j日 G:i');
            }

            $start_date = new DateTime($shibusawa->start_date);
            $tmp['start_date'] = $start_date->format('Y年n月j日');

            if (!empty($shibusawa->start_time)) {
                $tmp['start_date'] .= ' ' . $shibusawa->start_time;
            }

            $type = 2631;
            $reserve_type = new ReserveType();
            $reserve_type_data = $reserve_type->get_data_select($type);

            $tmp['reserve_name'] = mb_substr($reserve_type_data->name, 0, 12);
            $tmp['price'] = $reserve_type_data->price;

            $accounts = new Accounts();
            $account_data = $accounts->select_data($shibusawa->account_id);

            $tmp['name'] = $account_data->name;

            $tmp['difference'] = $tmp['payment'] - $tmp['price'];

            if ($tmp['difference'] == 0) {
                $tmp['color'] = 'table-primary';
            } elseif ($tmp['difference'] > 0) {
                $tmp['color'] = 'table-danger';
            } else {
                $tmp['color'] = 'table-warning';
            }


            $shibusawa_data[$t] = $tmp;
        }

        $month_first_date = $month . '-1';
        $pre_month =  date('Y-m', strtotime($month_first_date . '-1 month'));
        $next_month =  date('Y-m', strtotime($month_first_date . '+1 month'));
        $month = date('Y年m月', strtotime($month_first_date));
     

        return view('admin.cost.index', compact('data', 'shibusawa_data'))
            ->with('month', $month)->with('pre_month', $pre_month)->with('next_month', $next_month);
    }
    



}
