@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">顧客情報詳細</h1>
        <div class="text-right">
            <a href="/admin/account/detail/{{ $account_data->id }}"><button type="button" class="btn btn-primary">戻る</button></a>
        </div>
    </div>


    <div class="row">
        <table class="table">
            <form action="{{ route('accounts_change') }}" method="post" id="form">
                @csrf
                <input type="hidden" id="id" name="id" value="{{ $account_data->id }}">

                <tr>
                    <td>代表者名</td>
                    <td><input type="text" id="name" name="name" class="form-control" value="{{ $account_data->name }}">
                    </td>
                </tr>

                <tr>
                    <td>代表者名(カナ)</td>
                    <td><input type="text" id="name_kana" name="name_kana" class="form-control"
                            value="{{ $account_data->name_kana }}"></td>
                </tr>

                <tr>
                    <td>電話番号</td>
                    <td><input type="text" id="phone" name="phone" class="form-control"
                            value="{{ $account_data->phone }}"></td>
                </tr>

                <tr>
                    <td>メールアドレス</td>
                    <td><input type="email" id="email" name="email" class="form-control"
                            value="{{ $account_data->email }}"></td>
                </tr>

                <tr>
                    <td>都道府県</td>
                    <td>
                        <select name="pref" id="pref" class="form-control">
                            @foreach (['北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'] as $pref)

                                <option value="{{ $pref }}" <?php if ($pref === $account_data->pref) {
    echo 'selected';
} ?>>{{ $pref }}</option>

                            @endforeach

                        </select>

                    </td>
                </tr>

                <tr>
                    <td>住所</td>
                    <td><input type="text" id="adress" name="adress" class="form-control"
                            value="{{ $account_data->adress }}"></td>
                </tr>


                <tr>
                    <td></td>
                    <td><button type="submit" class="btn btn-primary">アカウント詳細を変更する</button></td>
                </tr>
                </tbody>
            </form>
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



@endsection
