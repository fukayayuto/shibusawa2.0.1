@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">{{ $reserve_type_data->name }} 予約日時変更</h1>
        <div class="text-right">
            <a href="/admin/entry/rechedule/{{ $entry_id }}"><button type="button" class="btn btn-primary">戻る</button></a>
        </div>
    </div>


    <div class="row">
        <table class="table">

            <form action="{{ route('entry_reschedule_post') }}" method="post" id="form">
                @csrf
                <input type="hidden" id="entry_id" name="entry_id" value="{{ $entry_id }}">
                <input type="hidden" id="new_id" name="new_id" value="{{ $new_reserve_data->id }}">
                <tbody>
                    <tr>
                        <td>予約日時(現在)</td>
                        <td>{{ $reserve_data->start_date }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>予約日時(変更後)</td>
                        <td>{{ $new_reserve_data->start_date }}</td>
                        <td></td>
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
