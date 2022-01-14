@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h2">{{ $reserve_name }} 予約詳細</h1>
        <a href="/admin/reserve/{{ $reserve_data->type }}"><button class="btn btn-primary ml-10"
                type="button">予約管理に戻る</button></a>
    </div>


    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="text-right">
        <a href="/admin/entry/create/{{ $reserve_data->id }}"><button type="button" class="btn btn-success">新規登録</button></a>
    </div>

    <div class="row">

        <table class="table">
            <thead>
                <tr>
                    <th>開始日</th>
                    <th>開始時間</th>
                    <th>定員枠</th>
                    <th>残り枠数</th>
                    <th></th>
                    <th>受付状態</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>{{ $reserve_data->start_date }}</td>
                    <td>{{ $reserve_data->start_time }}</td>
                    <td>{{ $reserve_data->count }}</td>
                    <td>{{ $reserve_data->left_seat }}</td>
                    <td>
                        <a href="/admin/reserve/count/{{ $reserve_data->id }}"><button class="btn-secondary ml-10"
                                type="button">予約枠の変更</button></a>
                    </td>
                    <td>
                        @if ($reserve_data->display_flg == 0)
                            受付中
                        @else
                            受付不可
                        @endif
                    </td>
                    <td>
                        <a href="/admin/reserve/display_flg/{{ $reserve_data->id }}"><button class="btn-secondary ml-10"
                                type="button">受付状態の変更</button></a>
                    </td>
                </tr>
            </tbody>

        </table>

    </div>



    <div class="row">

        <table class="table">
            <thead>
                <tr>
                    <th>代表者名</th>
                    <th>代表者カナ</th>
                    <th>都道府県</th>
                    <th>人数(大人、子供、幼児)</th>
                    <th>申し込みステータス</th>
                    <th>申し込み時間</th>
                    <th></th>
                </tr>
            </thead>


            @foreach ($data as $val)


                <tbody>
                    <tr>
                        <td>{{ $val['name'] }}</td>
                        <td>{{ $val['name_kana'] }}</td>
                        <td>{{ $val['pref'] }}</td>
                        <td>{{ $val['count'] }}人
                            ({{ $val['count_1'] }}人,{{ $val['count_2'] }}人,{{ $val['count_3'] }}人)
                        </td>
                        <td>
                            @if ($val['status'] == 1)
                                <button class="btn-success ml-10" type="button">確定</button>
                            @elseif($val['status'] == 2)
                                <button class="btn-danger ml-10" type="button">キャンセル</button>
                            @else
                                <button class="btn-warning ml-10" type="button">未確定</button>
                            @endif
                        </td>
                        <td>{{ $val['created_at'] }}</td>
                        <td><a href="/admin/entry/detail/{{ $val['id'] }}"><button class="btn-secondary ml-10"
                                    type="button">申し込み詳細へ</button></a></td>
                    </tr>
                </tbody>
            @endforeach

        </table>


    </div>

@endsection
