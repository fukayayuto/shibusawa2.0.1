@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <!-- <h1 class="h2">Dashboard</h1> -->
    <h1 class="h3">ステータスの変更</h1>
    <div class="text-right">
        <a href="/admin/entry/detail/{{$entry_data->id}}"><button type="button" class="btn btn-primary">戻る</button></a>
    </div>
</div>


<div class="row">
    <table class="table">

        <form action="{{route('change_status_post')}}" method="post" id="form">
            @csrf
            <input type="hidden" id="id" name="id" value="{{$entry_data->id}}">

            <tbody>
                <tr>
                    <td>申し込みステータス</td>
                    <td>
                        @if($entry_data->status == 0)
                        未確定
                        @elseif($entry_data->status == 1)
                        確定
                        @else
                        キャンセル
                        @endif
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>申し込みステータス(変更後)</td>
                    <td>
                        <select name="status" id="status" required>
                            <option value="1">確定</option>
                            <option value="2">キャンセル</option>
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