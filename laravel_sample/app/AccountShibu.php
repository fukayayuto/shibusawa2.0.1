<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AccountShibu extends Model
{
    public function get_data_lastest()
    {
        $account = DB::table('accounts_shibu')->get();
        return $account;
    }

    public function select_data($id)
    {
        $account = DB::table('accounts_shibu')->find($id);
        return $account;
    }
}
