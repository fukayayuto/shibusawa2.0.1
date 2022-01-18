@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">請求IDの変更</h1>
        <div class="text-right">
            <a href="/admin/entry/shibusawa/{{ $entry_data->id }}"><button type="button" class="btn btn-primary">戻る</button></a>
        </div>
    </div>


    <div class="row">
        <table class="table">

            <form action="{{ route('shibusawa_change_payment_id_post') }}" method="post" id="form">
                @csrf
                <input type="hidden" id="id" name="id" value="{{ $entry_data->id }}">

                <tbody>
                    <tr>
                        <td>請求ID(現在)</td>
                        <td>{{$entry_data->payment_id}}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>請求ID(変更後)</td>
                        <td><input type="number" id="payment_id" name="payment_id"></td>
                        <td><button id="btn" class="btn-secondary">自動作成</button></td>
                    </tr>
                   
                    <tr>
                        <td><button type="submit" class="btn btn-primary">変更する</button></td>
                        <td></td>
                        <td></td>

                    </tr>
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

<script>
    $(function() {
        $("#payment_id").click(function() {
            alert('uu');
        });
    });
</script>

@endsection
