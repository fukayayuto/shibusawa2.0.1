@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">新規テンプレート作成確認画面</h1>
    </div>


    <div class="row">
        <table class="table">

            <form action="{{ route('mail_template_create_post') }}" method="post" id="form">
                @csrf

                <input type="hidden" name="method" id="method" value="{{ $data['method'] }}">
                <input type="hidden" name="title" id="title" value="{{ $data['title'] }}">
                <input type="hidden" name="content" id="content" value="{{ $data['content'] }}">

                <tbody>

                    <tr>
                        <td style="width: 20%">使用方法</td>
                        <td>{{ $data['method'] }}</td>
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
                        <td>
                            <button type="submit" class="btn btn-primary">登録する</button>
                        </td>
            </form>

            <tr>
                <td></td>
                <td>
                    <form action="{{ route('mail_template_confirm_post') }}" method="post" id="fix">
                        @csrf
                        <input type="hidden" id="method" name="method" value="{{ $data['method'] }}">
                        <input type="hidden" id="title" name="title" value="{{ $data['title'] }}">
                        <input type="hidden" id="content" name="content" value="{{ $data['content'] }}">

                        <button type="submit" class="btn btn-secondary mt-18">修正</button>
                    </form>
                </td>
            </tr>



        </table>



    </div>


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

    <script>
        $(function() {
            $("#fix").submit(function() {
                if (window.confirm('修正しますか?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>

@endsection
