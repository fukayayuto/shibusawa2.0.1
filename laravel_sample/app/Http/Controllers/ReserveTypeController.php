<?php

namespace App\Http\Controllers;

use App\AccountShibu;
use App\Accounts;
use Illuminate\Http\Request;
use App\ReserveType;
use App\Reserve;
use App\Entry;
use App\EntryShibu;
use DateTime;
use Alert;

class ReserveTypeController extends Controller
{
    //詳細表示画面
    public function detail($type)
    {
        $reserve_type = new ReserveType();
        $reserve_type_data = $reserve_type->get_data_select($type);

        return view('admin.reserve.type.index', compact('reserve_type_data'));
    }

    //編集画面表示
    public function detail_edit($type)
    {
        $reserve_type = new ReserveType();
        $reserve_type_data = $reserve_type->get_data_select($type);

        $data = [];
        $data['id'] = $reserve_type_data->id;
        $data['name'] = $reserve_type_data->name;
        $data['detail'] = $reserve_type_data->detail;

        return view('admin.reserve.type.edit', compact('data'));
    }

    //編集画面表示
    public function detail_confirm(Request $request)
    {
        $data = [];
        $data['id'] = $request->id;
        $data['name'] = $request->name;
        $data['detail'] = $request->detail;

        return view('admin.reserve.type.confirm', compact('data'));
    }
    //詳細編集処理
    public function detail_change(Request $request)
    {
        $data = [];
        $data['id'] = $request->id;
        $data['name'] = $request->name;
        $data['detail'] = $request->detail;

        $reserve_type = new ReserveType();
        $res = $reserve_type->update_detail($data);
        $message = $res['message'];

        return redirect('/admin/reserve/type/' . $request->id)->with('message', $message);
    }

    //詳細編集修正
    public function detail_fix(Request $request)
    {
        $data = [];
        $data['id'] = $request->id;
        $data['name'] = $request->name;
        $data['detail'] = $request->detail;

        return view('admin.reserve.type.edit', compact('data'));
    }

    //予約種類作成
    public function type_create()
    {
        $data = [];
        $data['name'] = '';
        $data['detail'] = '';
        return view('admin.reserve.type.create.index', compact('data'));
    }

    //予約種類作成確認画面
    public function type_confirm(Request $request)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['detail'] = $request->detail;

        if ($file = $request->image) {
            $fileName = time() . $file->getClientOriginalName();
            $target_path = public_path('img/');
            $file->move($target_path, $fileName);
        } else {
            $fileName = "";
        }
        $data['file_name'] = $fileName;

        return view('admin.reserve.type.create.confirm', compact('data'));
    }

    //予約種類写真変更
    public function detail_image($type)
    {
        $reserve_type = new ReserveType();
        $reserve_type_data = $reserve_type->get_data_select($type);

        return view('admin.reserve.type.image', compact('reserve_type_data'));
    }

    //予約種類写真変更
    public function detail_image_post(Request $request)
    {
        if ($file = $request->image) {
            $fileName = time() . $file->getClientOriginalName();
            $target_path = public_path('img/');
            $file->move($target_path, $fileName);
        } else {
            $fileName = "";
        }

        $data = [];
        $data['id'] = $request->id;
        $data['image'] = $fileName;

        $reserve_type = new ReserveType();
        $reserve_type->update_image($data);
        $message = '写真を変更しました';
        return redirect('/admin/reserve')->with('message', $message);
    }


    //予約種類作成処理
    public function type_create_post(Request $request)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['detail'] = $request->detail;

        $reserve_type = new ReserveType();
        $insert_data = $reserve_type->create([
            'name' => $request->name,
            'detail' => $request->detail,
            'image' => $request->fileName,
        ]);



        $message = '予約種別を作成しました';
        return redirect('/admin/reserve')->with('message', $message);
    }

    //予約種類作成修正画面
    public function reserve_type_fix(Request $request)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['detail'] = $request->detail;

        return view('admin.reserve.type.create.index', compact('data'));
    }
}
