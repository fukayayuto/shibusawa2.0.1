@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">新規テンプレート作成確認画面</h1>
    </div>


    <div class="row">
        <table class="table">

            <form action="{{ route('mail_template_detail_confirm_post') }}" method="post" id="form">
                @csrf
                <input type="hidden" id="id" name="id" value="{{ $template_data['id'] }}">

                <tbody>

                    <tr>
                        <td style="width: 20%">使用方法</td>
                        <td>
                            <input type="text" name="method" id="method" value="{{ $template_data['method'] }}"
                                class="form-control" required>
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 20%">件名</td>
                        <td>
                            <input type="text" name="title" id="title" value="{{ $template_data['title'] }}"
                                class="form-control" required>
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 20%">本文</td>
                        <td>
                            <textarea name="content" id="content" cols="30" rows="20" class="form-control"
                                required>{{ $template_data['content'] }} </textarea>

                        </td>
                    </tr>

                    <tr>
                        <td style="width: 20%">埋め込み利用</td>
                        <td>
                            <select name="input_flg" id="input_flg" class="form-control">
                                <option value="0" <?php if ($template_data['input_flg'] == 0) {
    echo 'selected';
} ?>>使用しない</option>
                                <option value="1" <?php if ($template_data['input_flg'] == 1) {
    echo 'selected';
} ?>>使用する</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" class="btn btn-primary">確認画面へ</button>
                        </td>
            </form>

        </table>



    </div>


    <script>
        $(function() {
            $("#form").submit(function() {
                if (window.confirm('確認画面へ進みますか?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>


@endsection
