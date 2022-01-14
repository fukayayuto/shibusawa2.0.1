@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h2">{{ $reserve_name }} 予約管理</h1>
        <div class="text-right">
            <a href="/admin/entry/calendar/{{ $reserve_id }}"><button type="button" class="btn btn-primary">カレンダー表示</button></a>
            <a href="/admin/entry/list/{{ $reserve_id }}"><button type="button" class="btn btn-primary">申し込み一覧</button></a>
        </div>
    </div>

    <div class="text-right">
        <a href="/admin/reserve/list/create/{{ $reserve_id }}"><button type="button"
                class="btn btn-success">予約枠を新規作成</button></a>
    </div>

    <div class="container">
        <table class="table">
            <thead>

                <tr class="success">
                    <th>開始日</th>
                    <th>開始時間</th>
                    <th>予約枠</th>
                    <th>予約人数</th>
                    <th>受付状態</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @if (!empty($reserve_data))
                    @foreach ($reserve_data as $val)

                        <tr class="table-{{ $val['entry_color'] }}">
                            <td>{{ $val['start_date'] }}</td>
                            <td>{{ $val['start_time'] }}</td>
                            <td>{{ $val['count'] }}</td>
                            <td>{{ $val['entry_count'] }}</td>
                            <td>
                                @if ($val['display_flg'] == 0)
                                    受付中
                                @else
                                    受付不可
                                @endif
                            </td>
                            <td><a href="/admin/reserve/detail/{{ $val['id'] }}"><button type="button"
                                        class="btn btn-primary">詳細</button></a></td>
                            @if ($val['display_flg'] == 0)
                                @if ($val['count'] - $val['entry_count'] > 0)
                                    <td><a href="/admin/entry/create/{{ $val['id'] }}"><button type="button"
                                                class="btn btn-success">新規予約</button></a></td>
                                @else
                                    <td><button type="button" class="btn btn-secondary">予約不可</button></td>
                                @endif
                            @else
                                <td><button type="button" class="btn btn-secondary">予約不可</button></td>

                            @endif

                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

@endsection
