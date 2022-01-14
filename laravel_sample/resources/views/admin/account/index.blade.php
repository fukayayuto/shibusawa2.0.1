@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h2">顧客一覧</h1>
    </div>

    <table class="table">
        <thead>
            <tr class="success">
                <th>氏名</th>
                <th>氏名(カナ)</th>
                <th>メールアドレス</th>
                <th>電話番号</th>
                <th>住所</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @if (!empty($account_data))
                @foreach ($account_data as $val)
                    <tr>
                        <td>{{ $val->name }}</td>
                        <td>{{ $val->name_kana }}</td>
                        <td><a href="/admin/mail/create/{{ $val->id }}">{{ $val->email }}</a></td>
                        <td>{{ $val->phone }}</td>
                        <td>{{ $val->pref }}</td>
                        <td>{{ $val->adress }}</td>

                        <td><a href="/admin/account/detail/{{ $val->id }}"><button type="button"
                                    class="btn btn-primary">詳細</button></a></td>

                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
