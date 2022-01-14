<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReserveType extends Model
{
    protected $fillable = [
        'name', 'detail', 'image'
    ];

    public function get_data_all()
    {
        $reserve_type = DB::table('reserve_types')->get();
        return $reserve_type;
    }

    public function get_data_select($id)
    {
        $reserve_type = DB::table('reserve_types')->find($id);
        return $reserve_type;
    }

    //詳細変更
    public function update_detail($data)
    {
        $query = ReserveType::where('id', '=', $data['id'])->update([
            'name' => $data['name'],
            'detail' => $data['detail']
        ]);

        if (!$query) {
            return [
                'message' => '予約内容の詳細の変更に失敗しました',
                'alert' => 'danger',
            ];
        } else {
            return [
                'message' => '予約内容の詳細を変更しました',
                'alert' => 'success',
            ];
        }
    }

    //写真変更
    public function update_image($data)
    {
        $query = ReserveType::where('id', '=', $data['id'])->update([
            'image' => $data['image'],
        ]);

        if (!$query) {
            return [
                'message' => '写真を変更に失敗しました',
                'alert' => 'danger',
            ];
        } else {
            return [
                'message' => '写真を変更しました',
                'alert' => 'success',
            ];
        }
    }
}
