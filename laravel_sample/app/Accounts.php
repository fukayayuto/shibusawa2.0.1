<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Accounts extends Model
{

    protected $fillable = [
        'name', 'name_kana', 'email', 'phone', 'pref', 'adress',
    ];

    public function get_data_lastest()
    {
        $account = DB::table('accounts')->get();
        return $account;
    }

    public function select_data($id)
    {
        $account = DB::table('accounts')->find($id);
        return $account;
    }

    //アカウント検索(メールアドレスより)
    public function search_data_from_email($email)
    {
        $email = '%' . $email . '%';
        $account = Accounts::where('email', 'like', $email)->get();
        return $account;
    }

    //参加日時
    public function update_account($data)
    {
        $query = Accounts::where('id', '=', $data['id'])->update([
            'name' => $data['name'],
            'name_kana' => $data['name_kana'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'pref' => $data['pref'],
            'adress' => $data['adress'],
        ]);

        if (!$query) {
            return [
                'message' => 'アカウント情報の変更に失敗しました',
                'alert' => 'danger',
            ];
        } else {
            return [
                'message' => 'アカウント情報を変更しました',
                'alert' => 'success',
            ];
        }
    }
}
