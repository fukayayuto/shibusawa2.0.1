@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">予約人数変更</h1>
        <div class="text-right">
            <a href="/admin/entry/detail/{{ $entry_data->id }}"><button type="button" class="btn btn-primary">戻る</button></a>
        </div>
    </div>


    <div class="row">
        <table class="table">

            <form action="{{ route('change_count_post') }}" method="post" id="form">
                @csrf
                <input type="hidden" id="id" name="id" value="{{ $entry_data->id }}">

                <tbody>
                    <tr>
                        <td>参加人数(現在)</td>
                        <td>{{ $entry_data->count }}人 ( {{ $entry_data->count_1 }}人, {{ $entry_data->count_2 }}人,
                            {{ $entry_data->count_3 }}人) </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>参加人数(変更後)</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>大人</td>
                        <td>
                            <select name="count_1" id="count_1" class="form-control" required>
                                <option value="0" <?php if ($entry_data->count_1 == 0) {
    echo 'selected';
} ?>>0人</option>
                                <option value="1" <?php if ($entry_data->count_1 == 1) {
    echo 'selected';
} ?>>1人</option>
                                <option value="2" <?php if ($entry_data->count_1 == 2) {
    echo 'selected';
} ?>>2人</option>
                                <option value="3" <?php if ($entry_data->count_1 == 3) {
    echo 'selected';
} ?>>3人</option>
                                <option value="4" <?php if ($entry_data->count_1 == 4) {
    echo 'selected';
} ?>>4人</option>
                                <option value="5" <?php if ($entry_data->count_1 == 5) {
    echo 'selected';
} ?>>5人</option>
                            </select>
                        </td>
                        <td></td>
                    </tr>


                    <tr>
                        <td>子供</td>
                        <td>
                            <select name="count_2" id="count_2" class="form-control" required>
                                <option value="0" <?php if ($entry_data->count_2 == 0) {
    echo 'selected';
} ?>>0人</option>
                                <option value="1" <?php if ($entry_data->count_2 == 1) {
    echo 'selected';
} ?>>1人</option>
                                <option value="2" <?php if ($entry_data->count_2 == 2) {
    echo 'selected';
} ?>>2人</option>
                                <option value="3" <?php if ($entry_data->count_2 == 3) {
    echo 'selected';
} ?>>3人</option>
                                <option value="4" <?php if ($entry_data->count_2 == 4) {
    echo 'selected';
} ?>>4人</option>
                                <option value="5" <?php if ($entry_data->count_2 == 5) {
    echo 'selected';
} ?>>5人</option>
                            </select>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>幼児</td>
                        <td>
                            <select name="count_3" id="count_3" class="form-control" required>
                                <option value="0" <?php if ($entry_data->count_3 == 0) {
    echo 'selected';
} ?>>0人</option>
                                <option value="1" <?php if ($entry_data->count_3 == 1) {
    echo 'selected';
} ?>>1人</option>
                                <option value="2" <?php if ($entry_data->count_3 == 2) {
    echo 'selected';
} ?>>2人</option>
                                <option value="3" <?php if ($entry_data->count_3 == 3) {
    echo 'selected';
} ?>>3人</option>
                                <option value="4" <?php if ($entry_data->count_3 == 4) {
    echo 'selected';
} ?>>4人</option>
                                <option value="5" <?php if ($entry_data->count_3 == 5) {
    echo 'selected';
} ?>>5人</option>
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
