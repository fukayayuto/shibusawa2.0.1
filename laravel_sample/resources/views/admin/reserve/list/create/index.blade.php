@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">{{ $reserve_type_data->name }} 予約枠作成画面</h1>
        <div class="text-right">
            <a href="/admin/reserve/{{ $reserve_type_data->id }}"><button type="button" class="btn btn-primary">戻る</button></a>
        </div>
    </div>


    <form action="{{ route('reserve_list_create_post') }}" method="post" id="form">
        @csrf
        <div class="row">
            <table class="table">

                <input type="hidden" name="type" id="type" value="{{ $reserve_type_data->id }}">

                <tbody id="tboby">

                    <tr>
                        <td style="width: 20%">開始日時</td>
                        <td><input type="date" name="start_date" id="start_date" class="form-control" required></td>
                        <td>
                            <select name="start_time_1" id="start_time_1" class="form-control">
                                <option value="08">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                            </select>
                        </td>
                        <td>
                            <select name="start_time_2" id="start_time_2" class="form-control">
                                <option value="00">00</option>
                                <option value="30">30</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 20%">予約枠数</td>
                        <td colspan="3"><input type="number" name="count" id="count" class="form-control"></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td> <button type="submit" class="btn btn-primary">登録</button></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

    </form>





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

@endsection
