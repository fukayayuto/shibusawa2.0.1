@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">テンプレート詳細確認画面</h1>
        <div class="text-right">
            <a href="{{ route('mail_template') }}"><button type="submit" class="btn btn-primary">一覧に戻る</button></a>
        </div>
    </div>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="row">
        <table class="table">

            <tbody>

                <tr>
                    <td style="width: 20%">使用方法</td>
                    <td>{{ $template_data->method }}</td>
                </tr>

                <tr>
                    <td style="width: 20%">件名</td>
                    <td>{{ $template_data->title }}</td>
                </tr>

                <tr>
                    <td style="width: 20%">本文</td>
                    <td>{!! nl2br(e($template_data->content)) !!}</td>
                </tr>

                <tr>
                    <td style="width: 20%">埋め込み利用</td>
                    <td>
                        @if ($template_data->input_flg == 0)
                            使用しない
                        @else
                            使用する
                        @endif
                    </td>
                </tr>

                <tr>
                    <td style="width: 20%">作成日時</td>
                    <td>{{ $template_data->created_at }}</td>
                </tr>

                @if($template_data->edit_flg == 0)

                <tr class=".border.border-bottom-0">
                    <td></td>
                    <td>
                        <a href="/admin/mail/template/detail/{{ $template_data->id }}"><button
                                class="btn btn-primary">編集する</button></a>
                    </td>
                </tr>

                <tr class=".border-0">
                    <td></td>
                    <td>
                        <button class="btn btn-danger" id="delete_btn">削除する</button>
                    </td>
                </tr>

                @endif

        </table>
    </div>

    <script>
        $("#delete_btn").click(function() {
            var template_id = <?php echo $template_data->id; ?>;
            if (window.confirm('本当に削除してもいいですか?')) {
                location.href = "/mail/template/delete/" + template_id;
                return true;
            } else {
                return false;
            }
        });
    </script>



@endsection
