@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">新規テンプレート作成画面</h1>
        <div class="text-right">
            <a href="{{ route('mail_template') }}"><button type="button" class="btn btn-primary">戻る</button></a>
        </div>
    </div>


    <div class="row">
        <table class="table">

            <form action="{{ route('mail_template_confirm') }}" method="post" id="form">
                @csrf

                <tbody>

                    <tr>
                        <td style="width: 20%">使用方法</td>
                        <td><input type="text" name="method" id="method" class="form-control"
                                value="{{ $data['method'] }}" required></td>
                    </tr>

                    <tr>
                        <td style="width: 20%">件名</td>
                        <td><input type="text" name="title" id="title" class="form-control" value="{{ $data['title'] }}"
                                required></td>
                    </tr>

                    <tr>
                        <td style="width: 20%">本文</td>
                        <td>
                            <textarea name="content" id="content" cols="30" rows="20" class="form-control"
                                required>{{ $data['content'] }}</textarea>
                        </td>
                    </tr>

                    <tr>
                        <td><button type="submit" class="btn btn-primary">確認画面へ</button></td>
                        <td></td>
                        <td></td>

                    </tr>
            </form>

        </table>



    </div>


    <script>
        $(function() {
            $("#form").submit(function() {
                if (window.confirm('確認画面に進んでもいいですか?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>

@endsection
