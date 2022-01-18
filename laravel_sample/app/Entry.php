<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Entry extends Model
{

    protected $fillable = [
        'account_id', 'pay_method', 'reserve_id', 'count_1', 'count_2', 'count_3', 'adult_check',
    ];

    //全エントリー取得
    public function get_data_all()
    {
        $enrty = DB::table('entries')->orderBy('created_at', 'desc')->get();
        return $enrty;
    }

    //エントリー検索
    public function select_data_from_revervation_id($reverve_id)
    {
        $enrty = Entry::where('reserve_id', '=', $reverve_id)->get();

        return $enrty;
    }

    //個別エントリー取得
    public function select_data($entry_id)
    {
        $enrty = DB::table('entries')->find($entry_id);

        return $enrty;
    }

    //アカウントから取得
    public function select_data_from_account($account_id)
    {
        $enrty = Entry::where('account_id', '=', $account_id)->get();

        return $enrty;
    }

    //確定のエントリー取得
    public function get_data_status_confirm()
    {
        $enrty = DB::table('entries')->where('status', '=', 1)->orderBy('created_at', 'desc')->get();
        return $enrty;
    }

    //参加日時変更
    public function update_start_date($data)
    {
        $query = Entry::where('id', '=', $data['id'])->update([
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
        $query = Entry::where('id', '=', $data['id'])->update([
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
        $query = Entry::where('id', '=', $data['id'])->update([
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

    //予約束の変更
    public function reschedule($data)
    {
        $query = Entry::where('id', '=', $data['id'])->update([
            'reserve_id' => $data['reserve_id'],
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

    //入金登録
    public function payment_store($data)
    {
        $date = date('Y-m-d G:i');
        $query = Entry::where('id', '=', $data['id'])->update([
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
}
