<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mail extends Model
{
    protected $fillable = [
        'account_id', 'title', 'content',
    ];

    //全データ取得
    public function get_data_all()
    {
        $mails = DB::table('mails')->orderBy('created_at', 'desc')->paginate(15);
        return $mails;
    }

    //アカウント検索
    public function serach_data_from_account_id($account_id)
    {
        $mails = Mail::where('account_id', '=', $account_id)->orderBy('created_at', 'desc')->get();
        return $mails;
    }

    //個別メール情報取得
    public function select_data($id)
    {
        $enrty = DB::table('mails')->find($id);

        return $enrty;
    }
}
