@extends('layouts.parents')
@section('title', 'VeriTrans 4G - 取引結果')
@section('content')
    <div class="px-3 py-3 pt-md-5 mx-auto text-center">
        <ul class="list-unstyled">
            <li>本画面はVeriTrans4G コンビニ決済の取引サンプル画面です。</li>
            <li>お客様ECサイトのショッピングカートとVeriTrans4Gとを連動させるための参考、例としてご利用ください。</li>
        </ul>
    </div>
    <h5 class="mb-3 p-2 rounded bg-primary text-light">コンビニ決済：取引結果</h5>
    <hr>
    @if( isset($message) &&  $message != null)
        <p class="alert alert-danger">{{$message}}</p>
    @endif
    <table class="table table-striped">
        <tbody>
        <tr>
            <td>取引ID</td>
            <td>{{$orderId}}</td>
        </tr>
        <tr>
            <td>取引ステータス</td>
            <td>{{$mstatus}}</td>
        </tr>
        <tr>
            <td>結果コード</td>
            <td>{{$vResultCode}}</td>
        </tr>
        <tr>
            <td>結果メッセージ</td>
            <td>{{$mErrMsg}}</td>
        </tr>
        <tr>
            <td>受付番号</td>
            <td>{{$receiptNo}}</td>
        </tr>
        <tr>
            <td>払込票URL</td>
            <td>{{$haraikomiUrl}}</td>
        </tr>
        </tbody>
    </table>

    <div class="row">

        <div class="col-md-12">
            <hr class="mb-4">
            <a class="btn btn-primary btn-lg"
               href="{{ action('MenuController@index') }}">戻る</a>
        </div>
    </div>

@endsection
