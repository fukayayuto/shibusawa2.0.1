<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MailTemplate extends Model
{
    protected $fillable = [
        'title', 'content', 'method',
    ];

    //全エントリー取得
    public function get_data_all()
    {
        $data = DB::table('mail_templates')->orderBy('created_at', 'desc')->get();
        return $data;
    }

    //個別テンプレート取得
    public function select_data($id)
    {
        $data = DB::table('mail_templates')->find($id);

        return $data;
    }

    //埋め込み用テンプレート取得
    public function select_data_use_input()
    {
        $enrty = MailTemplate::where('input_flg', '=', '1')->get();

        return $enrty;
    }

    //埋め込み用テンプレート取得
    public function select_data_from_method($method)
    {
        $enrty = MailTemplate::where('method', '=', $method)->first();

        return $enrty;
    }

    //テンプレート詳細変更
    public function update_detail($data)
    {
        $query = MailTemplate::where('id', '=', $data['id'])->update([
            'method' => $data['method'],
            'title' => $data['title'],
            'content' => $data['content'],
            'input_flg' => $data['input_flg']
        ]);

        if (!$query) {
            return [
                'message' => 'テンプレートの変更に失敗しました',
                'alert' => 'danger',
            ];
        } else {
            return [
                'message' => 'テンプレートの変更をしました',
                'alert' => 'success',
            ];
        }
    }
}
