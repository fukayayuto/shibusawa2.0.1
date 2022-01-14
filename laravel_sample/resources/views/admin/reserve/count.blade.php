@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">予約枠数の変更</h1>
        <div class="text-right">
            <a href="/admin/reserve/detail/{{ $reserve_data->id }}"><button type="button" class="btn btn-primary">戻る</button></a>
        </div>
    </div>


    <div class="row">
        <table class="table">

            <form action="{{ route('reserve_count_post') }}" method="post" id="form">
                @csrf
                <input type="hidden" id="id" name="id" value="{{ $reserve_data->id }}">

                <tbody>
                    <tr>
                        <td>予約枠</td>
                        <td>{{ $reserve_data->count }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>予約状態(変更後)</td>
                        <td><input type="number" name="count" id="count" class="form-control" required></td>
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

@endsection
