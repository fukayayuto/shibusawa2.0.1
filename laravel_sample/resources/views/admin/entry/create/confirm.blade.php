@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">新規予約作成確認画面</h1>
    </div>


    <div class="row">
        <table class="table">

            <form action="{{ route('entry_create_post') }}" method="post" id="form">
                @csrf
                <input type="hidden" id="id" name="id" value="{{ $data['id'] }}">
                <input type="hidden" id="reserve_name" name="reserve_name" value="{{ $data['reserve_name'] }}">
                <input type="hidden" id="start_date" name="start_date" value="{{ $data['start_date'] }}">
                <input type="hidden" id="count_1" name="count_1" value="{{ $data['count_1'] }}">
                <input type="hidden" id="count_2" name="count_2" value="{{ $data['count_2'] }}">
                <input type="hidden" id="count_3" name="count_3" value="{{ $data['count_3'] }}">
                <input type="hidden" id="name" name="name" value="{{ $data['name'] }}">
                <input type="hidden" id="name_kana" name="name_kana" value="{{ $data['name_kana'] }}">
                <input type="hidden" id="email" name="email" value="{{ $data['email'] }}">
                <input type="hidden" id="phone" name="phone" value="{{ $data['phone'] }}">
                <input type="hidden" id="pref" name="pref" value="{{ $data['pref'] }}">
                <input type="hidden" id="adress" name="adress" value="{{ $data['adress'] }}">
                <input type="hidden" id="pay_method" name="pay_method" value="{{ $data['pay_method'] }}">
                <input type="hidden" id="adult_check" name="adult_check" value="{{ $data['adult_check'] }}">

                <tbody>
                    <tr>
                        <td>予約名</td>
                        <td>{{ $data['reserve_name'] }} </td>
                    </tr>
                    <tr>
                        <td>開始日</td>
                        <td>{{ $data['start_date'] }}</td>
                    </tr>
                    <tr>
                        <td>参加人数(大人)</td>
                        <td>{{ $data['count_1'] }}</td>
                    </tr>
                    <tr>
                        <td>参加人数(子供)</td>
                        <td>{{ $data['count_2'] }}</td>
                    </tr>
                    <tr>
                        <td>参加人数(幼児)</td>
                        <td>{{ $data['count_3'] }}</td>
                    </tr>


                    <tr>
                        <td>代表者名</td>
                        <td>{{ $data['name'] }}</td>
                    </tr>

                    <tr>
                        <td>代表者名(カナ)</td>
                        <td>{{ $data['name_kana'] }}</td>
                    </tr>

                    <tr>
                        <td>メールアドレス</td>
                        <td>{{ $data['email'] }}</td>
                    </tr>

                    <tr>
                        <td>電話番号</td>
                        <td>{{ $data['phone'] }}</td>
                    </tr>

                    <tr>
                        <td>都道府県</td>
                        <td>{{ $data['pref'] }}</td>
                    </tr>

                    <tr>
                        <td>住所</td>
                        <td>{{ $data['adress'] }}</td>
                    </tr>

                    <tr>
                        <td>支払い方法</td>
                        <td>
                            @if ($data['pay_method'] == 1)
                                銀行振り込み
                            @else
                                paypay
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>20歳以上の有無</td>
                        <td>
                            @if ($data['adult_check'] == 0)
                                いない
                            @else
                                いる
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" class="btn btn-primary">登録する</button>
            </form>

            <form action="{{ route('entry_create_fix') }}" method="post" id="fix">
                @csrf
                <input type="hidden" id="id" name="id" value="{{ $data['id'] }}">
                <input type="hidden" id="reserve_name" name="reserve_name" value="{{ $data['reserve_name'] }}">
                <input type="hidden" id="start_date" name="start_date" value="{{ $data['start_date'] }}">
                <input type="hidden" id="count_1" name="count_1" value="{{ $data['count_1'] }}">
                <input type="hidden" id="count_2" name="count_2" value="{{ $data['count_2'] }}">
                <input type="hidden" id="count_3" name="count_3" value="{{ $data['count_3'] }}">
                <input type="hidden" id="name" name="name" value="{{ $data['name'] }}">
                <input type="hidden" id="name_kana" name="name_kana" value="{{ $data['name_kana'] }}">
                <input type="hidden" id="email" name="email" value="{{ $data['email'] }}">
                <input type="hidden" id="phone" name="phone" value="{{ $data['phone'] }}">
                <input type="hidden" id="pref" name="pref" value="{{ $data['pref'] }}">
                <input type="hidden" id="adress" name="adress" value="{{ $data['adress'] }}">
                <input type="hidden" id="pay_method" name="pay_method" value="{{ $data['pay_method'] }}">
                <input type="hidden" id="adult_check" name="adult_check" value="{{ $data['adult_check'] }}">

                <button type="submit" class="btn btn-secondary mt-7">修正する</button>
            </form>
            </td>

            </tr>


        </table>



    </div>


    <script>
        $(function() {
            $("#form").submit(function() {
                if (window.confirm('この内容で登録しますか?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
    <script>
        $(function() {
            $("#fix").submit(function() {
                if (window.confirm('修正しますか?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>

@endsection
