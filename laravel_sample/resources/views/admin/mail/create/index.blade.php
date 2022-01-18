@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">送信用メール作成</h1>
        <div class="text-right">
            <a href="{{ route('mail') }}"><button type="button" class="btn btn-primary">戻る</button></a>
        </div>
    </div>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if (!empty($template_data))
        <div class="text-right">
            <div class="row mt-0 mb-1">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="text-left">テンプレート挿入 : <button type="button" id="input_btn"
                            class="btn-secondary ml-3">挿入</button>
                    </div>

                    <select name="template" id="template" class="form-control">
                        @foreach ($template_data as $val)
                            <option value="{{ $val->method }}">{{ $val->method }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
        </div>
    @endif


    <div class="row">
        <table class="table">

            <form action="{{ route('mail_create_confirm') }}" method="post" id="form">
                @csrf
                <input type="hidden" name="account_id" id="account_id" value="{{ $data['account_id'] }}">
                <input type="hidden" name="adress" id="adress" value="{{ $data['adress'] }}">
                @if(!empty($data['s_confirm_flg']))
                <input type="hidden" name="s_confirm_flg" id="s_confirm_flg" value="{{ $data['s_confirm_flg'] }}">
                @endif

                <tbody>

                    <tr>
                        <td style="width: 20%">宛先</td>
                        <td>{{ $data['adress'] }}</td>
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
                        <td></td>
                        <td><button type="submit" class="btn btn-primary">確認画面へ</button></td>
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

    <script>
        // ボタンクリック時
        $("#input_btn").click(function() {
            var template = $("#template").val();
            var account_id = <?php echo $data['account_id']; ?>;

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                    //POST通信
                    type: "post",
                    //ここでデータの送信先URLを指定します。
                    url: "/admin/mail/template/input",
                    dataType: "json",
                    data: {
                        template: template,
                        account_id: account_id,
                    },

                })
                //通信が成功したとき
                .then((data) => {
                    $("#title").val(data['title']);
                    $("#content").val(data['content']);
                })
                //通信が失敗したとき
                .fail((error) => {
                    console.log(error.statusText);
                });

        });
    </script>

@endsection
