@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">メール送信内容詳細</h1>
        <div class="text-right">
            <a href="{{ route('mail') }}"><button type="submit" class="btn btn-primary">一覧に戻る</button></a>
        </div>
    </div>

    <div class="row">
        <table class="table">

            <tbody>
                <tr>
                    <td style="width: 20%">宛先</td>
                    <td>{{ $mail_data->email }} ( {{ $mail_data->account_name }} )</td>
                </tr>

                <tr>
                    <td style="width: 20%">件名</td>
                    <td>{{ $mail_data->title }}</td>
                </tr>

                <tr>
                    <td style="width: 20%">本文</td>
                    <td>{!! nl2br(e($mail_data->content)) !!}</td>
                </tr>


                <tr>
                    <td style="width: 20%">送信日時</td>
                    <td>{{ $mail_data->created_at }}</td>
                </tr>

        </table>
    </div>


@endsection
