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

class EntryShibuController extends Controller
{
    //エントリー日時変更
    public function change_start_date($id)
    {
        $entry = new EntryShibu();
        $entry_data = $entry->select_data($id);

        $start_date = new DateTime($entry_data->start_date);
        $entry_data->start_date = $start_date->format('Y年n月j日');

        return view('admin.reserve.entry.shibusawa.change_start_date', compact('entry_data'));
    }

    //エントリー日時変更
    public function shibusawa_entry_calendar()
    {
        $entry = new EntryShibu();
        $entry_data = $entry->get_data_lastest();

        $data = [];

        foreach ($entry_data as $k => $val) {
            if ($val->status != 0) {
                continue;
            }
            $tmp = [];
            $tmp['id'] = $val->id;

            $created_at = new DateTime($val->created_at);
            $tmp['created_at'] = $created_at->format('n月j日');

            $tmp['count_1'] = $val->count_1;
            $tmp['count_2'] = $val->count_2;
            $tmp['count_3'] = $val->count_3;

            $tmp['count'] = $tmp['count_1'] + $tmp['count_2'] + $tmp['count_3'];

            $start_date = new DateTime($val->start_date);
            $tmp['start_date'] = $start_date->format('n月j日');

            $tmp['start_time'] = $val->start_time;

            $tmp['start_station'] = $val->start_station;
            $tmp['finish_station'] = $val->finish_station;
            $tmp['status'] = $val->status;

            $data[$k] = $tmp;
        }
        return view('admin.entry.calendar.shibusawa', compact('data'));
    }

    //カレンダー表示データ
    public function set_data()
    {
        $data = [];
        $entry = new EntryShibu();
        $entry_data_list = $entry->get_data_lastest();

        $i = 0;

        foreach ($entry_data_list as $k => $val) {
            if($val->status != 2){
                $tmp = [];
                $tmp['start'] = $val->start_date;
                $tmp['title'] = $val->start_time;
    
                $tmp['color'] = '#00FF7F';
                $tmp['url'] = '/admin/entry/shibusawa/' . $val->id;
    
                $tmp['textColor'] = 'black';

                if($val->status == 0){
                    $tmp['color'] = '#FFD700';
                }
                $data[$i] = $tmp; 
                $i++;     
            }

                
        }

        return $data;
    }

    //エントリー日時変更
    public function shibusawa_entry_create()
    {
        $type = 2631;
        $reserve_type = new ReserveType();
        $reserve_type_data = $reserve_type->get_data_select($type);

        $data = [];
        $data['start_date'] = '';
        $data['start_time'] = '';
        $data['start_station'] = '';
        $data['start_'] = '';
        $data['count_3'] = '';
        $data['count_1'] = '';
        $data['count_2'] = '';
        $data['count_3'] = '';
        $data['name'] = '';
        $data['name_kana'] = '';
        $data['email'] = '';
        $data['pref'] = '';
        $data['adress'] = '';
        $data['pay_method'] = '';
        $data['adult_check'] = '';


        return view('admin.entry.shibusawa.create.index', compact('data', 'reserve_type_data'));
    }

     //請求ID変更
     public function shibusawa_change_payment_id($id)
     {
         $entry = new EntryShibu();
         $entry_data = $entry->select_data($id);
  
         return view('admin.reserve.entry.shibusawa.change_payment_id', compact('entry_data'));
     }
 
     //請求ID変更後
     public function shibusawa_change_payment_id_post(Request $request)
     {
         $data['id'] = $request->id;
         $data['payment_id'] = $request->payment_id;
 
         $entry = new EntryShibu();
         $res = $entry->update_payment_id($data);
         $message = $res['message'];
 
         return redirect('/admin/entry/shibusawa/' . $request->id)->with('message', $message);
     }

    
}
