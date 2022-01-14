<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EntryShibu extends Model
{

    protected $fillable = [
        'start_date', 'start_time', 'start_station', 'finish_station', 'start_place', 'finish_place', 'count_1', '	count_2', 'count_3', 'adult_check', 'pay_method', 'account_id',
    ];

    public function get_data_lastest()
    {
        $reserve = DB::table('entry_shibus')->get();
        return $reserve;
    }

    public function select_data($id)
    {
        $reserve = DB::table('entry_shibus')->find($id);
        return $reserve;
    }

    //確定のエントリー取得
    public function get_data_status_confirm()
    {
        $enrty = DB::table('entry_shibus')->where('status', '=', 1)->orderBy('created_at', 'desc')->get();
        return $enrty;
    }

    //参加日時変更
    public function update_start_date($data)
    {
        $query = EntryShibu::where('id', '=', $data['id'])->update([
            'start_date' => $data['start_date'],
            'start_time' => $data['start_time']
        ]);

        if (!$query) {
            return [
                'message' => '予約日時の変更に失敗しました',
                'alert' => 'danger',
            ];
        } else {
            return [
                'message' => '予約日時の変更しました',
                'alert' => 'success',
            ];
        }
    }

    //参加日時変更
    public function update_count($data)
    {
        $query = EntryShibu::where('id', '=', $data['id'])->update([
            'count_1' => $data['count_1'],
            'count_2' => $data['count_2'],
            'count_3' => $data['count_3'],
        ]);

        if (!$query) {
            return [
                'message' => '予約人数の変更に失敗しました',
                'alert' => 'danger',
            ];
        } else {
            return [
                'message' => '予約人数を変更しました',
                'alert' => 'success',
            ];
        }
    }

    //ステータス変更
    public function update_status($data)
    {
        $query = EntryShibu::where('id', '=', $data['id'])->update([
            'status' => $data['status'],
        ]);

        if (!$query) {
            return [
                'message' => '申し込みステータスの変更に失敗しました',
                'alert' => 'danger',
            ];
        } else {
            return [
                'message' => '申し込みステータスを変更しました',
                'alert' => 'success',
            ];
        }
    }

     //ステータス変更
     public function update_pickup($data)
     {
         $query = EntryShibu::where('id', '=', $data['id'])->update([
             'start_station' => $data['start_station'],
             'start_place' => $data['start_place'],
             'finish_station' => $data['finish_station'],
             'finish_place' => $data['finish_place'],
         ]);
 
         if (!$query) {
             return [
                 'message' => '乗車、降車場所の変更に失敗しました',
                 'alert' => 'danger',
             ];
         } else {
             return [
                 'message' => '乗車、降車場所を変更しました',
                 'alert' => 'success',
             ];
         }
     }

    //入金登録
    public function payment_store($data)
    {
        $date = date('Y-m-d G:i');
        $query = EntryShibu::where('id', '=', $data['id'])->update([
            'payment' => $data['payment'],
            'payment_date' => $date,
        ]);

        if (!$query) {
            return [
                'message' => '入金登録に失敗しました',
                'alert' => 'danger',
            ];
        } else {
            return [
                'message' => '入金登録しました',
                'alert' => 'success',
            ];
        }
    }

    //アカウントからエントリー検索
    public function select_data_from_account($account_id)
    {
        $enrty = EntryShibu::where('account_id', '=', $account_id)->get();
        return $enrty;
    }

    //全エントリー取得
    public function get_data_all()
    {
        $enrty = DB::table('entry_shibus')->orderBy('created_at', 'desc')->get();
        return $enrty;
    }
}
