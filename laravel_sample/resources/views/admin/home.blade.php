@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h2">ホーム画面</h1>
    </div>

    <div class="container">


        <table class="table">

            @if (empty($entry_data))
                @if (empty($shibusawa_entry_data))
                    <thead>
                        <tr>
                            <th>新規予約はありません</th>
                        </tr>
                    </thead>
                @endif
            @endif

            @if (!empty($entry_data))
                <thead>
                    <tr class="success">
                        <th>申し込み日時</th>
                        <th>予約名</th>
                        <th>代表者名</th>
                        <th>参加人数(大人、子供、幼児)</th>
                        <th>都道府県</th>
                        <th>予約日時</th>
                        <th>ステータス</th>
                        <th></th>
                    </tr>
                </thead>
            @endif

            <tbody class="mb-10">
                @if (!empty($entry_data))
                    @foreach ($entry_data as $val)
                        <tr>
                            <td>{{ $val['created_at'] }}</td>
                            <td>{{ $val['reserve_name'] }}</td>
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

                            <td><a href="/entry/detail/{{ $val['id'] }}"><button type="button"
                                        class="btn btn-primary">詳細</button></a>
                            </td>

                        </tr>
                    @endforeach
                @endif
            </tbody>

            @if (!empty($shibusawa_entry_data))
                @if (empty($entry_data))
                    <thead>
                        <tr class="success">
                            <th>申し込み日時</th>
                            <th>予約名</th>
                            <th>代表者名</th>
                            <th>参加人数(大人、子供、幼児)</th>
                            <th>都道府県</th>
                            <th>予約日時</th>
                            <th>ステータス</th>
                            <th></th>
                        </tr>
                    </thead>
                @endif
            @endif

            <tbody class="mb-10">
                @if (!empty($shibusawa_entry_data))
                    @foreach ($shibusawa_entry_data as $value)
                        <tr>
                            <td>{{ $value['created_at'] }}</td>
                            <td>{{ $value['reserve_name'] }}</td>
                            <td>{{ $value['name'] }}</td>
                            <td>{{ $value['count'] }}人 ({{ $value['count_1'] }}人 ,{{ $value['count_2'] }}人
                                ,{{ $value['count_3'] }}人)
                            </td>
                            <td>{{ $value['pref'] }}</td>
                            <td>{{ $value['start_date'] }}</td>
                            @if ($value['status'] == 0)
                                <td><button type="button" class="btn btn-warning">未確定</button></td>
                            @elseif($value['status'] == 1)
                                <td><button type="button" class="btn btn-success">確定</button></td>
                            @elseif($value['status'] == 2)
                                <td><button type="button" class="btn btn-danger">キャンセル</button></td>
                            @endif

                            <td><a href="/entry/shibusawa/{{ $value['id'] }}"><button type="button"
                                        class="btn btn-primary">詳細</button></a>
                            </td>

                        </tr>
                    @endforeach
                @endif
            </tbody>


        </table>
    </div>



@endsection
