<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Reserve extends Model
{

    protected $fillable = [
        'type', 'count', 'start_date', 'start_time',
    ];


    public function get_data($type)
    {
        $reserve = Reserve::where('type', '=', $type)->get();
        return $reserve;
    }

    //最近のデータ取得
    public function get_data_recently($id)
    {
        $start = date("Y-m-d", strtotime("-1 week"));
        $last = date("Y-m-d", strtotime("+3 month"));
        $reserve = Reserve::where('type', '=', $id)
            ->where('start_date', '>', $start)
            ->orderBy('start_date', 'asc')
            ->get();
        return $reserve;
    }


    //予約詳細のためのデータ取得
    public function select_data_from_reserve_id($reserve_id)
    {
        $reserve = DB::table('reserves')->find($reserve_id);
        return $reserve;
    }

    //予約状況変更
    public function update_display_flg($reserve_id, $display_flg)
    {
        $query = Reserve::where('id', '=', $reserve_id)->update([
            'display_flg' => $display_flg,
        ]);

        if (!$query) {
            return [
                'message' => '予約状態の変更に失敗しました',
                'alert' => 'danger',
            ];
        } else {
            return [
                'message' => '予約状態を変更しました',
                'alert' => 'success',
            ];
        }
    }

    //予約枠数編集
    public function update_count($reserve_id, $count)
    {
        $query = Reserve::where('id', '=', $reserve_id)->update([
            'count' => $count,
        ]);

        if (!$query) {
            return [
                'message' => '予約枠数の変更に失敗しました',
                'alert' => 'danger',
            ];
        } else {
            return [
                'message' => '予約枠数を変更しました',
                'alert' => 'success',
            ];
        }
    }
}
