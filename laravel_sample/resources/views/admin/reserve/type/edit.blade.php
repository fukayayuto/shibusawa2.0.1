@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <!-- <h1 class="h2">Dashboard</h1> -->
    <h1 class="h3">予約種類別内容詳細</h1>
    <div class="text-right">
    <a href="/admin/reserve/type/{{$data['id']}}"><button type="button" class="btn btn-primary">戻る</button></a>
    </div>
</div>

@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<form action="{{route('reserve_type_detail_confirm')}}" method="post" id="form">
    @csrf
<input type="hidden" name="id" id="id" value="{{$data['id']}}" >

<div class="row">
    <table class="table">

        <tr>
            <td style="width: 20%">予約名</td>
            <td><input type="text" class="form-control" name="name" id="name" value="{{ $data['name'] }}"></td>
        </tr>

        <tr>
            <td style="width: 20%">詳細</td>
            <td><textarea name="detail" id="detail" cols="30" rows="15" class="form-control">{{ $data['detail'] }}</textarea></td>
        </tr>

        <tr>
            <td></td>
            <td><button type="submit" class="btn btn-primary">確認画面へ</a></td>
        </tr>
        </tbody>
    </table>

</div>

</form>




@endsection
