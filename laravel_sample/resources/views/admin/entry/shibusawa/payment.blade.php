@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">入金登録</h1>
        <div class="text-right">
            <a href="/admin/entry/detail/{{ $entry_data->id }}"><button type="button" class="btn btn-primary">戻る</button></a>
        </div>
    </div>


    <div class="row">
        <table class="table">

            <form action="{{ route('entry_payment_post') }}" method="post" id="form">
                @csrf
                <input type="hidden" id="id" name="id" value="{{ $entry_data->id }}">
                <input type="hidden" id="old_payment" name="old_payment" value="{{ $entry_data->payment }}">

                <tbody>

                    <tr>
                        <td style="width: 25%">請求ID</td>
                        <td>{{ number_format($entry_data->payment_id) }}</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="width: 25%">請求金額</td>
                        <td>{{ number_format($entry_data->price) }} 円</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="width: 25%">現在の入金金額</td>
                        <td>{{ number_format($entry_data->payment) }} 円</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="width: 25%">入金額<br>(支払いの場合は、- にしてください)</td>
                        <td><input type="number" id="payment" name="payment" class="form-control" placeholder="入金額入力"
                                required>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><button type="submit" class="btn btn-primary">入金登録</button></td>
                        <td></td>
                        <td></td>
                    </tr>
            </form>

        </table>


    </div>

    <script>
        $(function() {
            $("#form").submit(function() {
                if (window.confirm('入金登録しますか?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>

@endsection
