@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h2">渋沢ツアー申し込み一覧</h1>
        <div class="text-right">
            <a href="{{ route('reserve') }}"><button type="button" class="btn btn-primary">予約種別一覧へ</button></a>
            <a href="{{ route('shibusawa_entry_calendar') }}"><button type="button"
                    class="btn btn-primary">カレンダー表示</button></a>
        </div>
    </div>

    <table class="table">
        {{-- <div class="text-right">
            <a href="{{ route('shibusawa_entry_create') }}"><button type="button" class="btn btn-success">新規予約</button></a>
        </div> --}}
        <thead>
            <tr class="success">
                <th>申し込み日時</th>
                <th>参加人数(大人、子供、幼児)</th>
                <th>予約日</th>
                <th>予約時間</th>
                <th>乗車駅</th>
                <th>降車駅</th>
                <th>ステータス</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($data as $val) : ?>
            <tr>
                <td>{{ $val['created_at'] }}</td>
                <td>{{ $val['count'] }}人 ({{ $val['count_1'] }}人 ,{{ $val['count_2'] }}人 ,{{ $val['count_3'] }}人)
                </td>
                <td>{{ $val['start_date'] }}</td>
                <td>{{ $val['start_time'] }}</td>
                <td>{{ $val['start_station'] }}</td>
                <td>{{ $val['finish_station'] }}</td>
                @if ($val['status'] == 0)
                    <td><button type="button" class="btn btn-warning">未確定</button></td>
                @elseif($val['status'] == 1)
                    <td><button type="button" class="btn btn-success">確定</button></td>
                @elseif($val['status'] == 2)
                    <td><button type="button" class="btn btn-danger">キャンセル</button></td>
                @endif

                <td><a href="/admin/entry/shibusawa/{{ $val['id'] }}"><button type="button"
                            class="btn btn-primary">詳細</button></a></td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
@endsection
