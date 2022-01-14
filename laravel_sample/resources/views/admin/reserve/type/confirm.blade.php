@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">予約種類別内容確認画面</h1>
    </div>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form action="{{ route('reserve_type_detail_change') }}" method="post" id="form">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $data['id'] }}">
        <input type="hidden" name="name" id="name" value="{{ $data['name'] }}">
        <input type="hidden" name="detail" id="detail" value="{{ $data['detail'] }}">
        <div class="row">
            <table class="table">

                <tr>
                    <td style="width: 20%">予約名</td>
                    <td>{{ $data['name'] }}</td>
                </tr>

                <tr>
                    <td style="width: 20%">詳細</td>
                    <td>{!! nl2br(e($data['detail'])) !!}</td>
                </tr>

                <tr>
                    <td></td>
                    <td><button class="btn btn-primary">変更する</button></td>
                </tr>
    </form>

    <form action="{{ route('reserve_type_fix') }}" method="post">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $data['id'] }}">
        <input type="hidden" name="name" id="name" value="{{ $data['name'] }}">
        <input type="hidden" name="detail" id="detail" value="{{ $data['detail'] }}">
        <tr>
            <td></td>
            <td><button class="btn btn-secondary">修正</button></td>
        </tr>
    </form>
    </tbody>
    </table>

    </div>

    <script>
        $(function() {
            $("#form").submit(function() {
                if (window.confirm('この内容で修正しますか?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>



@endsection
