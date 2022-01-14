@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">新規テンプレート作成確認画面</h1>
    </div>


    <div class="row">
        <table class="table">

            <form action="{{ route('mail_template_detail_change_post') }}" method="post" id="form">
                @csrf
                <input type="hidden" id="id" name="id" value="{{ $template_data['id'] }}">
                <input type="hidden" name="method" id="method" value="{{ $template_data['method'] }}">
                <input type="hidden" name="title" id="title" value="{{ $template_data['title'] }}">
                <input type="hidden" name="content" id="content" value="{{ $template_data['content'] }}">
                <input type="hidden" name="input_flg" id="input_flg" value="{{ $template_data['input_flg'] }}">

                <tbody>

                    <tr>
                        <td style="width: 20%">使用方法</td>
                        <td>{{ $template_data['method'] }}</td>
                    </tr>

                    <tr>
                        <td style="width: 20%">件名</td>
                        <td>{{ $template_data['title'] }}</td>
                    </tr>

                    <tr>
                        <td style="width: 20%">本文</td>
                        <td>{!! nl2br(e($template_data['content'])) !!}</td>
                    </tr>

                    <tr>
                        <td style="width: 20%">埋め込み利用</td>
                        <td>
                            @if ($template_data['input_flg'] == 0)
                                使用しない
                            @else
                                使用する
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" class="btn btn-primary">変更する</button>
                        </td>
            </form>

            <tr>
                <td></td>
                <td>
                    <form action="{{ route('mail_template_detail_fix_post') }}" method="post" id="fix">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ $template_data['id'] }}">
                        <input type="hidden" id="method" name="method" value="{{ $template_data['method'] }}">
                        <input type="hidden" id="title" name="title" value="{{ $template_data['title'] }}">
                        <input type="hidden" id="content" name="content" value="{{ $template_data['content'] }}">

                        <button type="submit" class="btn btn-secondary mt-18">修正</button>
                    </form>
                </td>
            </tr>



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
