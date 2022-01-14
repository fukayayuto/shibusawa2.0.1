@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h2">{{ $reserve_type_data->name }} 申し込み一覧</h1>
        <div class="text-right">
            <a href="/admin/reserve/{{ $reserve_type_data->id }}"><button type="button"
                    class="btn btn-primary">予約枠一覧</button></a>
            <a href="/admin/entry/calendar/{{ $reserve_type_data->id }}"><button type="button"
                    class="btn btn-primary">カレンダー表示</button></a>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr class="success">
                <th>申し込み日時</th>
                <th>代表者名</th>
                <th>参加人数(大人、子供、幼児)</th>
                <th>都道府県</th>
                <th>予約日時</th>
                <th>ステータス</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @if (!empty($entry_data))
                @foreach ($entry_data as $val)
                    <tr>
                        <td>{{ $val['created_at'] }}</td>
                        <td>{{ $val['name'] }}</td>
                        <td>{{ $val['count'] }}人 ({{ $val['count_1'] }}人 ,{{ $val['count_2'] }}人
                            ,{{ $val['count_3'] }}人)
                        </td>
                        <td>{{ $val['pref'] }}</td>
                        <td>{{ $val['start_date'] }}</td>
                        @if ($val['status'] == 0)
                            <td><button type="button" class="btn btn-warning">未確定</button></td>
                        @elseif($val['status'] == 1)
                            <td><button type="button" class="btn btn-success">確定</button></td>
                        @elseif($val['status'] == 2)
                            <td><button type="button" class="btn btn-danger">キャンセル</button></td>
                        @endif

                        <td><a href="/admin/entry/detail/{{ $val['id'] }}"><button type="button"
                                    class="btn btn-primary">詳細</button></a>
                        </td>

                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
