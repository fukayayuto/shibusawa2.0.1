@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <!-- <h1 class="h2">Dashboard</h1> -->
    <h1 class="h3">予約人数変更</h1>
    <div class="text-right">
        <a href="/admin/entry/shibusawa/{{ $entry_data->id }}"><button type="button"
                class="btn btn-primary">戻る</button></a>
    </div>
</div>


<div class="row">
    <table class="table">

        <form action="{{ route('shibusawa_change_pickup_post') }}" method="post" id="form">
            @csrf
            <input type="hidden" id="id" name="id" value="{{ $entry_data->id }}">

            <tbody>
                <tr>
                    <td width='20%'>乗車場所</td>
                    <td>{{ $entry_data->start_station }}</td>
                    <td>{{$entry_data->start_place}}</td>
                </tr>
                <tr>
                    <td width='20%'>降車場所</td>
                    <td>{{ $entry_data->finish_station }}</td>
                    <td>{{$entry_data->finish_place}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td width='20%'>乗車場所(変更後)</td>
                    <td>
                        <select name="start_station" id="start_station" class="form-control">

                            <option value="東京駅">東京駅</option>
                            <option value="その他">その他</option>

                        </select>
                    </td>
                    <td><input type="text" name="start_place" id="start_plece" class="form-control"></td>
                </tr>

                <tr>
                    <td width='20%'>降車場所(変更後)</td>
                    <td>
                        <select name="finish_station" id="finish_station" class="form-control">
                            <option value="東京駅">東京駅</option>
                            <option value="その他">その他</option>
                        </select>
                    </td>
                    <td><input type="text" name ="finish_place" id="finish_place" class="form-control"></td>
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