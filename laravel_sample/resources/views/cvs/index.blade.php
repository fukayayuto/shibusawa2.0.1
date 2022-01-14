@extends('layouts.parents')
@section('title', 'VeriTrans 4G - コンビニ決済')
@section('content')
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">買い物かご</span>
                <span class="badge badge-secondary badge-pill">1</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                        <h6 class="my-0">サンプル商品</h6>
                        <small class="text-muted">4G-S-001</small>
                    </div>
                    <span class="text-muted">&yen;{{ $amount }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                        <h6 class="my-0">送料</h6>
                        <small class="text-muted">配送先:東京</small>
                    </div>
                    <span class="text-muted">&yen;0</span>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    <span>合計金額</span>
                    <strong>&yen;{{ $amount }}</strong>
                </li>
            </ul>

        </div>

        <div class="col-md-8 order-md-1">
            <div class="alert alert-danger">
                本画面はVeriTrans4G コンビニ決済の取引サンプル画面です。<br>
                お客様ECサイトのショッピングカートとVeriTrans4Gとを連動させるための参考、例としてご利用ください。<br>
                また、本画面では基本的なパラメータのみを表示させていますので、開発ガイドも合わせてご参照してください。<br>
            </div>
            <h5 class="mb-3 p-2 rounded bg-primary text-light">コンビニ決済：決済請求</h5>
            <div class="row">
                <div class="col-1 col-sm-2"><img src="{{asset("images/CVS_SevenEleven.jpg")}}" alt="セブンイレブン"></div>
                <div class="col-2 col-sm-2"><img src="{{asset("images/CVS_Famima.jpg")}}" alt="ファミリーマート"></div>
                <div class="col-1 col-sm-2"><img src="{{asset("images/CVS_Lawson.jpg")}}" alt="ローソン"></div>
                <div class="col-1 col-sm-2"><img src="{{asset("images/CVS_Ministop.jpg")}}" alt="ミニストップ"></div>
                <div class="col-2 col-sm-2"><img src="{{asset("images/CVS_Seicomart.jpg")}}" alt="セイコーマート"></div>
                <div class="col-1 col-sm-2"><img src="{{asset("images/CVS_Dailyyamazaki.jpg")}}" alt="デイリーヤマザキ"></div>
            </div>
            <hr class="mb-4">
            <form method="post" action="{{ url('/cvs') }}" class="needs-validation" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="orderId">取引ID</label>
                    <div class="row">
                        <div class="col-12 col-sm-8">
                            <input type="text" class="form-control" id="orderId" name="orderId" value="{{ $orderId }}"
                                   maxlength="100"
                                   required>
                        </div>
                        <div class="col-3 col-sm-4">
                            <button class="btn btn-primary set-order-id" data-bind="orderId" onclick="return false;">取引ID更新</button>
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <label for="serviceOptionType">決済サービスオプション</label>
                    <select class="form-select" id="serviceOptionType" name="serviceOptionType">
                        <option value="sej">セブンイレブン</option>
                        <option value="lawson">ローソン(ローソン、ミニストップ、セイコーマート)</option>
                        <option value="famima">ファミリーマート</option>
                        <option value="other">その他(デイリーヤマザキ)</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label for="amount">金額</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="{{ $amount }}"
                           maxlength="8" required>
                </div>

                <div class="mb-3">
                    <label for="name1">姓</label>
                    <input type="text" class="form-control" id="name1" name="name1" maxlength="20" required>
                </div>

                <div class="mb-3">
                    <label for="name2">名</label>
                    <input type="text" class="form-control" id="name2" name="name2" maxlength="20" required>
                </div>

                <div class="mb-3">
                    <label for="telNo">電話番号</label>
                    <input type="tel" class="form-control" id="telNo" name="telNo" maxlength="13" required>
                    <p class="text-warning">※"-"(ハイフン)区切りも可能</p>
                </div>

                <div class="mb-3">
                    <label for="payLimit">支払期限</label>
                    <input type="text" class="form-control" id="payLimit" name="payLimit" maxlength="10" required>
                    <p class="text-warning">※形式：YYYYMMDD or YYYY/MM/DD</p>
                </div>

                <div class="mb-3">
                    <label for="payLimitHhmm">支払期限時分</label>
                    <input type="text" class="form-control" id="payLimitHhmm" name="payLimitHhmm" maxlength="5">
                    <p class="text-warning">※形式：HH:mm or HHmm</p>

                </div>
                <div class="mb-3">
                    <label for="push_url">プッシュURL</label>
                    <input type="url" inputmode="url" class="form-control" id="push_url" name="pushUrl"  placeholder="" maxlength="256">
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary btn-lg" id="proceed_payment_cvs" type="submit">購入</button>
            </form>
        </div>

    </div>
@endsection
