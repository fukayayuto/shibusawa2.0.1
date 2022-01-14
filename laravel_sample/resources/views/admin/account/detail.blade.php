@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">顧客情報詳細</h1>
        <div class="text-right">
            <a href="{{ route('accounts') }}"><button type="button" class="btn btn-primary">アカウント一覧へ</button></a>
        </div>
    </div>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif


    <div class="row">
        <table class="table">

            <tr>
                <td>代表者名</td>
                <td>{{ $account_data->name }}</td>
            </tr>

            <tr>
                <td>代表者名(カナ)</td>
                <td>{{ $account_data->name_kana }}</td>
            </tr>

            <tr>
                <td>電話番号</td>
                <td>{{ $account_data->phone }}</td>
            </tr>

            <tr>
                <td>メールアドレス</td>
                <td><a href="/admin/mail/create/{{ $account_data->id }}">{{ $account_data->email }}</a></td>
            </tr>

            <tr>
                <td>都道府県</td>
                <td>{{ $account_data->pref }}</td>
            </tr>

            <tr>
                <td>住所</td>
                <td>{{ $account_data->adress }}</td>
            </tr>

            <tr>
                <td>登録日時</td>
                <td>{{ $account_data->created_at }}</td>
            </tr>

            <tr>
                <td>更新日時</td>
                <td>{{ $account_data->updated_at }}</td>
            </tr>

            <tr>
                <td></td>
                <td><a href="/admin/account/edit/{{ $account_data->id }}"><button
                            class="btn btn-primary">アカウント詳細を編集する</button></a></td>
            </tr>
            </tbody>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th>履歴</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr class="table-light">
                    <th>予約名</th>
                    <th>開始日時</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @if (!empty($entry_data))
                    @foreach ($entry_data as $val)

                        <tr>
                            <td>{{ $val['reserve_name'] }}</td>
                            <td class="ml-4">{{ $val['start_date'] }}</td>
                            <td><a href="/admin/entry/detail/{{ $val['id'] }}"><button type="botton"
                                        class="btn btn-primary">講座詳細へ</button></a></td>
                        </tr>

                    @endforeach
                @endif

                @if (!empty($shibusawa_entry_data))
                    @foreach ($shibusawa_entry_data as $value)

                        <tr>
                            <td>{{ $value['reserve_name'] }}</td>
                            <td class="ml-4">{{ $value['start_date'] }}</td>
                            <td><a href="/admin/entry/shibusawa/{{ $value['id'] }}"><button type="botton"
                                        class="btn btn-primary">講座詳細へ</button></a></td>
                        </tr>

                    @endforeach
                @endif


            </tbody>
        </table>




    </div>

    <script>
        $(function() {
            $("#form").submit(function() {
                if (window.confirm('この内容で変更しますか?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>



@endsection
