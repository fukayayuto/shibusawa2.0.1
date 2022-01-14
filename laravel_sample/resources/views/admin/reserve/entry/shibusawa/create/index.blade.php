@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">新規予約作成画面</h1>
        <div class="text-right">
            <a href="/admin/reserve/{{ $reserve_type_data->id }}"><button type="button" class="btn btn-primary">戻る</button></a>
        </div>
    </div>


    <div class="row">
        <table class="table">

            <form action="{{ route('entry_shibusawa_create_confirm_post') }}" method="post" id="form">
                @csrf

                <tbody>
                    <tr>
                        <td style="width: 20%">予約名</td>
                        <td>{{ $reseeve_type_data->name }} </td>
                    </tr>

                    <tr>
                        <td style="width: 20%">予約時間</td>
                        <td>
                            <div class="col-sm-4">
                                <select name="start_data" id="start_data" class="form-control">
                                    <option value="東京駅">東京駅</option>
                                    <option value="その他">その他</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select name="start_time" id="start_time" class="form-control">
                                    <option value="東京駅">東京駅</option>
                                    <option value="その他">その他</option>
                                </select>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 20%">乗車駅</td>
                        <td>
                            <select name="start_station" id="start_station" class="form-control">
                                <option value="東京駅">東京駅</option>
                                <option value="その他">その他</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 20%">乗車場所</td>
                        <td><input type="text" name="start_place" id="start_place" class="form-control"
                                value="{{ $data['start_place'] }}">
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 20%">降車駅</td>
                        <td><input type="text" name="finish_station" id="finish_station" class="form-control"
                                value="{{ $data['finish_station'] }}" required></td>
                    </tr>

                    <tr>
                        <td style="width: 20%">降車場所</td>
                        <td><input type="text" name="finishi_place" id="finishi_place" class="form-control"
                                value="{{ $data['finishi_place'] }}">
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 20%">参加人数(大人)</td>
                        <td>
                            <select name="count_1" id="count_1" class="form-control">
                                <option value="0" <?php if ($data['count_1'] == 0) {
    echo 'selected';
} ?>>0人</option>
                                <option value="1" <?php if ($data['count_1'] == 1) {
    echo 'selected';
} ?>>1人</option>
                                <option value="2" <?php if ($data['count_1'] == 2) {
    echo 'selected';
} ?>>2人</option>
                                <option value="3" <?php if ($data['count_1'] == 3) {
    echo 'selected';
} ?>>3人</option>
                                <option value="4" <?php if ($data['count_1'] == 4) {
    echo 'selected';
} ?>>4人</option>
                                <option value="5" <?php if ($data['count_1'] == 5) {
    echo 'selected';
} ?>>5人</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">参加人数(子供)</td>
                        <td>
                            <select name="count_2" id="count_2" class="form-control">
                                <option value="0" <?php if ($data['count_2'] == 0) {
    echo 'selected';
} ?>>0人</option>
                                <option value="1" <?php if ($data['count_2'] == 1) {
    echo 'selected';
} ?>>1人</option>
                                <option value="2" <?php if ($data['count_2'] == 2) {
    echo 'selected';
} ?>>2人</option>
                                <option value="3" <?php if ($data['count_2'] == 3) {
    echo 'selected';
} ?>>3人</option>
                                <option value="4" <?php if ($data['count_2'] == 4) {
    echo 'selected';
} ?>>4人</option>
                                <option value="5" <?php if ($data['count_2'] == 5) {
    echo 'selected';
} ?>>5人</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">参加人数(幼児)</td>
                        <td>
                            <select name="count_3" id="count_3" class="form-control">
                                <option value="0" <?php if ($data['count_3'] == 0) {
    echo 'selected';
} ?>>0人</option>
                                <option value="1" <?php if ($data['count_3'] == 1) {
    echo 'selected';
} ?>>1人</option>
                                <option value="2" <?php if ($data['count_3'] == 2) {
    echo 'selected';
} ?>>2人</option>
                                <option value="3" <?php if ($data['count_3'] == 3) {
    echo 'selected';
} ?>>3人</option>
                                <option value="4" <?php if ($data['count_3'] == 4) {
    echo 'selected';
} ?>>4人</option>
                                <option value="5" <?php if ($data['count_3'] == 5) {
    echo 'selected';
} ?>>5人</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 20%">20歳以上の有無</td>
                        <td>
                            <select name="adult_check" id="adult_check" class="form-control">
                                <option value="0" <?php if ($data['adult_check'] == 0) {
    echo 'selected';
} ?>>いない</option>
                                <option value="1" <?php if ($data['adult_check'] == 1) {
    echo 'selected';
} ?>>いる</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 20%">代表者名</td>
                        <td><input type="text" name="name" id="name" class="form-control" value="{{ $data['name'] }}"
                                required></td>
                    </tr>

                    <tr>
                        <td style="width: 20%">代表者名(カナ)</td>
                        <td><input type="text" name="name_kana" id="name_kana" class="form-control"
                                value="{{ $data['name_kana'] }}" required></td>
                    </tr>

                    <tr>
                        <td style="width: 20%">メールアドレス</td>
                        <td><input type="email" name="email" id="email" class="form-control"
                                value="{{ $data['email'] }}" required></td>
                    </tr>

                    <tr>
                        <td style="width: 20%">電話番号</td>
                        <td><input type="phone" name="phone" id="phone" class="form-control"
                                value="{{ $data['phone'] }}" required></td>
                    </tr>

                    <tr>
                        <td style="width: 20%">都道府県</td>
                        <td>
                            <select name="pref" id="pref" class="form-control">
                                @foreach (['北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'] as $pref)

                                    <option value="{{ $pref }}" <?php if ($pref == $data['pref']) {
    echo 'selected';
} ?>>{{ $pref }}</option>

                                @endforeach
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 20%">住所</td>
                        <td><input type="text" name="adress" id="adress" class="form-control"
                                value="{{ $data['adress'] }}" required></td>
                    </tr>

                    <tr>
                        <td style="width: 20%">支払い方法</td>
                        <td>
                            <select name="pay_method" id="pay_method" class="form-control">
                                <option value="1" <?php if ($data['pay_method'] == 1) {
    echo 'selected';
} ?>>銀行振り込み</option>
                            </select>
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
