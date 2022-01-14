@extends('layouts.parents')
@section('title', 'VeriTrans 4G - 決済方法選択')
@section('content')
    <main class="container">
        <div class="px-3 py-3 pt-md-5 mx-auto text-center">
            <h1 class="display-4">決済方法選択</h1>
            <p class="lead">
                本画面はVeriTrans4G 取引管理用のメニューのサンプル画面です。<br>
                お客様ECサイトのショッピングカートとVeriTrans4Gとを連動させるための参考、例としてご利用ください。<br>
                また、本画面では基本的なパラメータのみを表示させていますので、開発ガイドも合わせてご参照してください。<br>
            </p>
        </div>
        <div class="row mb-3 text-center">
            <div class="col">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 fw-normal">カード</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>&nbsp</li>
                            <li>クレジットカード決済</li>
                            <li>&nbsp</li>
                        </ul>
                        <button type="button" class="w-100 btn btn-lg btn-primary"
                                onclick="window.location.href='{{ action("CardController@index") }}'">
                            決済手続きへ
                        </button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 fw-normal">カード(本人認証あり)</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>本人認証</li>
                            <li>+</li>
                            <li>クレジットカード決済</li>
                        </ul>
                        <button type="button" class="w-100 btn btn-lg btn-primary"
                                onclick="window.location.href='{{ action("MpiController@index") }}'">決済手続きへ
                        </button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 fw-normal">コンビニ</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>&nbsp</li>
                            <li>コンビニ決済申し込み</li>
                            <li>&nbsp</li>
                        </ul>
                        <button type="button" class="w-100 btn btn-lg btn-primary"
                                onclick="window.location.href='{{ action("CvsController@index") }}'">決済手続きへ
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
