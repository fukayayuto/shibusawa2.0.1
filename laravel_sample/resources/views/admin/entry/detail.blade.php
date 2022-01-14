@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">申し込み詳細</h1>
        <div class="text-right">
            <a href="/admin/reserve/{{ $reserve_data->type }}"><button type="button" class="btn btn-primary">申し込み一覧へ</button></a>
        </div>
    </div>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif


    <div class="row">
        <table class="table">

            <thead>
                <tr>
                    <th scope="col">予約情報</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>講座名</td>
                    <td colspan="2">{{ $reserve_data->reserve_name }}</td>
                </tr>
                <tr>
                    <td>開始日時</td>
                    <td>{{ $reserve_data->start_date }} {{ $reserve_data->start_time }}</td>
                    <td><a href="/admin/entry/reschedule/{{ $entry_data->id }}"><button class="btn-secondary ml-10"
                                type="button">予約日時を変更する</button></a></td>
                </tr>
                <tr>
                    <td>予約人数</td>
                    <td>{{ $entry_data->count }}人
                        ({{ $entry_data->count_1 }}人、{{ $entry_data->count_2 }}人、{{ $entry_data->count_3 }}人)</td>
                    <td><a href="/admin/entry/count/{{ $entry_data->id }}"><button class="btn-secondary ml-10"
                                type="button">予約人数を変更する</button></a></td>
                </tr>

                <tr>
                    <td>20歳以上の有無</td>
                    <td>
                        @if ($entry_data->adult_check == 1)
                            いる
                        @else
                            いない
                        @endif
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td>申し込みステータス</td>
                    <td>
                        @if ($entry_data->status == 0)
                            <button class="btn-warning ml-10" type="button">未確定</button>
                        @elseif($entry_data->status == 1)
                            <button class="btn-success ml-10" type="button">確定</button>
                        @else
                            <button class="btn-danger ml-10" type="button">キャンセル</button>
                        @endif
                    </td>
                    <td><a href="/admin/entry/status/{{ $entry_data->id }}"><button class="btn-secondary ml-10"
                                type="button">申し込みステータスを変更する</button></a></td>
                </tr>

                <tr>
                    <td>お支払い方法</td>
                    <td>
                        @if ($entry_data->pay_method == 1)
                            銀行振り込み
                        @else
                            いない
                        @endif
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td>請求金額</td>
                    <td>{{ number_format($entry_data->price) }} 円</td>
                    <td></td>
                </tr>

                <tr>
                    <td>入金金額</td>
                    <td>{{ number_format($entry_data->payment) }} 円</td>
                    <td><a href="/admin/entry/payment/{{ $entry_data->id }}"><button class="btn-secondary ml-10"
                                type="button">入金登録をする</button></a></td>
                </tr>

                <tr>
                    <td>入金日時</td>
                    @if (!empty($entry_data->payment_date))
                        <td>{{ $entry_data->payment_date }} </td>
                    @else
                        <td>入金実績なし </td>
                    @endif
                    <td></td>
                </tr>




                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <thead>
                    <tr>
                        <th scope="col">顧客情報</th>
                        <th><a href="/admin/account/detail/{{ $account_data->id }}"><button class="btn-secondary ml-10"
                                    type="button" id="rebook_btn">顧客情報を変更する</button></a></th>
                        <th></th>
                    </tr>
                </thead>

                <tr>
                    <td>代表者名</td>
                    <td>{{ $account_data->name }}</td>
                    <td></td>
                </tr>

                <tr>
                    <td>代表者名(カナ)</td>
                    <td>{{ $account_data->name_kana }}</td>
                    <td></td>
                </tr>

                <tr>
                    <td>電話番号</td>
                    <td>{{ $account_data->phone }}</td>
                    <td></td>
                </tr>

                <tr>
                    <td>メールアドレス</td>
                    <td>{{ $account_data->email }}</td>
                    <td></td>
                </tr>

                <tr>
                    <td>住所</td>
                    <td>{{ $account_data->pref }} {{ $account_data->adress }} </td>
                    <td></td>
                </tr>
            </tbody>
            </form>
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
