@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">参加日時変更</h1>
        <div class="text-right">
            <a href="/admin/entry/shibusawa/{{ $entry_data->id }}"><button type="button" class="btn btn-primary">戻る</button></a>
        </div>
    </div>


    <div class="row">
        <table class="table">

            <form action="{{ route('shibusawa_change_start_date_post') }}" method="post" id="form">
                @csrf
                <input type="hidden" id="id" name="id" value="{{ $entry_data->id }}">

                <tbody>
                    <tr>
                        <td>参加日時(現在)</td>
                        <td>{{ $entry_data->start_date }} {{ $entry_data->start_time }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>参加日(変更後)</td>
                        <td>
                            <input type="date" id="start_date" name="start_date" required>
                            <select name="start_time_1" id="start_time_1" required>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                            </select>
                            <select name="start_time_2" id="start_time_2" required>
                                <option value="00">00</option>
                                <option value="30">30</option>
                            </select>
                        </td>
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
