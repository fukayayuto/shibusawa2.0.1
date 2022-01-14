@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">送信用メール作成</h1>
        <div class="text-right">
            <a href="{{ route('mail') }}"><button type="button" class="btn btn-primary">戻る</button></a>
        </div>
    </div>


    <div class="row">
        <table class="table">

            <form action="{{ route('mail_create_post') }}" method="post" id="form">
                @csrf
                <input type="hidden" name="account_id" id="account_id" value="{{ $data['account_id'] }}">
                <input type="hidden" name="adress" id="adress" value="{{ $data['adress'] }}">
                <input type="hidden" name="title" id="title" value="{{ $data['title'] }}">
                <input type="hidden" name="content" id="content" value="{{ $data['content'] }}">


                <tbody>

                    <tr>
                        <td style="width: 20%">宛先</td>
                        <td>{{ $data['adress'] }}</td>
                    </tr>

                    <tr>
                        <td style="width: 20%">件名</td>
                        <td>{{ $data['title'] }}</td>
                    </tr>

                    <tr>
                        <td style="width: 20%">本文</td>
                        <td>{!! nl2br(e($data['content'])) !!}</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><button type="submit" class="btn btn-primary">送信する</button></td>
                    </tr>
            </form>

            <tr>
                <td></td>
                <td>
                    <form action="{{ route('mail_create_fix') }}" method="post" id="fix">
                        @csrf
                        <input type="hidden" name="account_id" id="account_id" value="{{ $data['account_id'] }}">
                        <input type="hidden" name="adress" id="adress" value="{{ $data['adress'] }}">
                        <input type="hidden" name="title" id="title" value="{{ $data['title'] }}">
                        <input type="hidden" name="content" id="content" value="{{ $data['content'] }}">

                        <button type="submit" class="btn btn-secondary mt-18">修正</button>
                    </form>
                </td>
            </tr>


        </table>



    </div>


    <script>
        $(function() {
            $("#form").submit(function() {
                if (window.confirm('この内容で送信しますか?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>

@endsection
