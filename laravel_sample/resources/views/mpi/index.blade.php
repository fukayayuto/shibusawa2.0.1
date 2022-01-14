@extends('layouts.parents')
@section('title', 'VeriTrans 4G - クレジットカード決済(3D認証付き)')
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
                本画面はVeriTrans4G カード決済(3D認証付き)の取引サンプル画面です。<br>
                お客様ECサイトのショッピングカートとVeriTrans4Gとを連動させるための参考、例としてご利用ください。<br>
                また、本画面では基本的なパラメータのみを表示させていますので、開発ガイドも合わせてご参照してください。<br>
            </div>
            <h5 class="mb-3 p-2 rounded bg-primary text-light">カード決済(3D認証付き)：決済請求</h5>
            <div class="row">
                <div class="col-4 col-sm-4"><img src="{{asset("images/MPI_VerifiedByVisa.png")}}"
                                                 alt="Verified by Visa"></div>
                <div class="col-4 col-sm-4"><img src="{{asset("images/MPI_MasterSecureCode.png")}}"
                                                 alt="MasterCard SecureCode"></div>
                <div class="col-4 col-sm-4"><img src="{{asset("images/MPI_JSecure.png")}}" alt="JCB J/Secure"></div>
            </div>
            <hr class="mb-4">
            <form method="post" action="{{ url('/mpi') }}" class="needs-validation" onclick="return false;"
                  id="token_form" novalidate>
                @csrf
                <input type="hidden" id="token_api_key" value="{{ $tokenApiKey }}">
                <input type="hidden" id="token" name="token" value="">


                <div class="mb-3">
                    <label for="orderId">取引ID</label>
                    <div class="row">
                        <div class="col-12 col-sm-8">
                            <input type="text" class="form-control" id="orderId" name="orderId" value="{{ $orderId }}"
                                   maxlength="100"
                                   required>
                        </div>
                        <div class="col-3 col-sm-4">
                            <button class="btn btn-primary set-order-id" data-bind="orderId">取引ID更新</button>
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <label for="amount">金額</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="{{ $amount }}"
                           maxlength="8" required>
                </div>

                <div class="mb-3">
                    <label for="paymentMode">決済種別</label>
                    <select class="form-select" id="paymentMode" name="paymentMode">
                        <option value="mpi-complete">完全認証(3D-Secure認証が完全に成功した場合のみ決済する)</option>
                        <option value="mpi-company">通常認証(カード会社リスク負担にて決済する)</option>
                        <option value="mpi-merchant">通常認証(カード会社か加盟店リスク負担にて決済する)</option>
                        <option value="mpi-none">3D-Secure認証のみ(決済しない)</option>
                    </select>
                    <p class="text-warning">※この項目は消費者が選択せず、内部的に設定いただく項目です。</p>
                </div>

                <div class="mb-3">
                    <label for="withCapture">与信方法</label>
                    <select class="form-select" id="withCapture" name="withCapture">
                        <option value="false">与信のみ(与信成功後に売上処理を行う必要があります)</option>
                        <option value="true">与信売上(与信と同時に売上処理も行います)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="card_number">クレジットカード番号</label>
                    <input type="text" inputmode="numeric" class="form-control" id="card_number" placeholder=""
                           pattern="[0-9]{14,16}"
                           maxlength="19" required>
                </div>

                <div class="mb-3">
                    <label for="cc_exp">有効期限</label>
                    <input type="text" class="form-control" id="cc_exp" placeholder="MM/YY" pattern="[0-9/]{4,5}"
                           maxlength="5" required>
                    <p class="text-warning">※形式：MM/YY</p>
                </div>

                <div class="mb-3">
                    <label for="cc_csc">セキュリティコード</label>
                    <input type="text" inputmode="numeric" class="form-control" id="cc_csc" placeholder=""
                           pattern="[0-9]{3,4}"
                           maxlength="4" required>
                </div>

                <div class="mb-3">
                    <label for="push_url">プッシュ通知先URL</label>
                    <input type="text" inputmode="url" class="form-control" id="push_url" name="pushUrl" placeholder=""
                           maxlength="256">
                </div>

                <div class="mb-3">
                    <label for="jpo1">支払方法</label>
                    <select class="form-select" id="jpo1" name="jpo1">
                        <option value="10">一括払い(支払回数の設定は不要)</option>
                        <option value="61">分割払い(支払回数を設定してください)</option>
                        <option value="80">リボ払い(支払回数の設定は不要)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jpo2">支払回数</label>
                    <input type="text" class="form-control" id="jpo2" name="jpo2" placeholder="" pattern="[0-9]{2}"
                           maxlength="2" required>
                    <p class="text-warning">※一桁の場合は数値の前に"0"をつけてください。(例:01)</p>
                </div>

                <div class="mb-3">
                    <label for="browserDeviceCategory">端末種別</label>
                    <select class="form-select" id="browserDeviceCategory" name="browserDeviceCategory">
                        <option value=""></option>
                        <option value="0">PC</option>
                        <option value="1">mobile</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="verifyTimeout">本人認証有効期限</label>
                    <input type="text" class="form-control" id="verifyTimeout" name="verifyTimeout" placeholder=""
                           pattern="[0-9]{1,3}" maxlength="3">
                    <p class="text-warning">※分単位で指定してください。</p>
                </div>

                <div class="mb-3">
                    <label for="deviceChannel">デバイスチャネル</label>
                    <select class="form-select" id="deviceChannel" name="deviceChannel">
                        <option value="02">ブラウザベース</option>
                        <option value=""></option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="messageCategory">メッセージカテゴリ</label>
                    <select class="form-select" id="messageCategory" name="messageCategory">
                        <option value=""></option>
                        <option value="01">PA（支払い認証）</option>
                        <option value="02">NPA（支払い無しの認証）</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cardholderName">カード保有者名</label>
                    <input type="text" class="form-control" id="cardholderName" name="cardholderName"
                           placeholder="CARDHOLDER NAME"
                           autocomplete="cc-name">
                    <p class="text-warning">※3Dセキュア 2.0の場合は必須です。</p>
                </div>

                <div class="mb-3">
                    <label for="cardholderEmail">カード保有者メールアドレス</label>
                    <input type="email" class="form-control" id="cardholderEmail" name="cardholderEmail"
                           placeholder="foo@example.com">
                </div>

                <div class="mb-3">
                    <label for="cardholderHomePhoneCountry">カード保有者自宅電話番号国コード</label>
                    <input type="text" class="form-control" id="cardholderHomePhoneCountry" name="cardholderHomePhoneCountry">
                </div>

                <div class="mb-3">
                    <label for="cardholderHomePhoneNumber">カード保有者自宅電話番号</label>
                    <input type="tel" class="form-control" id="cardholderHomePhoneNumber" name="cardholderHomePhoneNumber">
                </div>

                <div class="mb-3">
                    <label for="cardholderMobilePhoneNumber">カード保有者携帯電話番号</label>
                    <input type="tel" class="form-control" id="cardholderMobilePhoneNumber" name="cardholderMobilePhoneNumber">
                </div>

                <div class="mb-3">
                    <label for="cardholderWorkPhoneCountry">カード保有者勤務先電話番号国コード</label>
                    <input type="text" class="form-control" id="cardholderWorkPhoneCountry" name="cardholderWorkPhoneCountry">
                </div>

                <div class="mb-3">
                    <label for="cardholderWorkPhoneNumber">カード保有者勤務先電話番号</label>
                    <input type="tel" class="form-control" id="cardholderWorkPhoneNumber" name="cardholderWorkPhoneNumber">
                </div>

                <div class="mb-3">
                    <label for="billingAddressCity">請求先住所_市区町村</label>
                    <input type="text" class="form-control" id="billingAddressCity" name="billingAddressCity">
                </div>

                <div class="mb-3">
                    <label for="billingAddressCountry">請求先住所_国</label>
                    <input type="text" class="form-control" id="billingAddressCity" name="billingAddressCountry">
                </div>

                <div class="mb-3">
                    <label for="billingAddressLine1">請求先住所1</label>
                    <input type="text" class="form-control" id="billingAddressLine1" name="billingAddressLine1">
                </div>

                <div class="mb-3">
                    <label for="billingAddressLine2">請求先住所2</label>
                    <input type="text" class="form-control" id="billingAddressLine2" name="billingAddressLine2">
                </div>

                <div class="mb-3">
                    <label for="billingAddressLine3">請求先住所3</label>
                    <input type="text" class="form-control" id="billingAddressLine3" name="billingAddressLine3">
                </div>

                <div class="mb-3">
                    <label for="billingPostalCode">請求先郵便番号</label>
                    <input type="text" class="form-control" id="billingPostalCode" name="billingPostalCode">
                </div>

                <div class="mb-3">
                    <label for="billingAddressState">請求先住所_都道府県</label>
                    <input type="text" class="form-control" id="billingAddressState" name="billingAddressState">
                </div>

                <div class="mb-3">
                    <label for="shippingAddressCity">配送先住所_市区町村</label>
                    <input type="text" class="form-control" id="shippingAddressCity" name="shippingAddressCity">
                </div>

                <div class="mb-3">
                    <label for="shippingAddressCountry">配送先住所_国</label>
                    <input type="text" class="form-control" id="shippingAddressCountry" name="shippingAddressCountry">
                </div>

                <div class="mb-3">
                    <label for="shippingAddressLine1">配送先住所1</label>
                    <input type="text" class="form-control" id="shippingAddressLine1" name="shippingAddressLine1">
                </div>

                <div class="mb-3">
                    <label for="shippingAddressLine2">配送先住所2</label>
                    <input type="text" class="form-control" id="shippingAddressLine2" name="shippingAddressLine2">
                </div>

                <div class="mb-3">
                    <label for="shippingAddressLine3">配送先住所3</label>
                    <input type="text" class="form-control" id="shippingAddressLine3" name="shippingAddressLine3">
                </div>

                <div class="mb-3">
                    <label for="shippingPostalCode">配送先郵便番号</label>
                    <input type="text" class="form-control" id="shippingPostalCode" name="shippingPostalCode">
                </div>

                <div class="mb-3">
                    <label for="shippingAddressState">配送先住所_都道府県</label>
                    <input type="text" class="form-control" id="shippingAddressState" name="shippingAddressState">
                </div>

                <div class="mb-3">
                    <label for="customerIp">消費者IPアドレス</label>
                    <input type="text" class="form-control" id="customerIp" name="customerIp">
                </div>

                <div class="mb-3">
                    <label for="withChallenge">チャレンジ認証フラグ</label>
                    <select class="form-select" id="withChallenge" name="withChallenge">
                        <option value=""></option>
                        <option value="true">チャレンジ認証を行う</option>
                        <option value="false">チャレンジ認証を行わない</option>
                    </select>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary btn-lg" id="proceed_payment" type="submit">購入</button>
            </form>
        </div>

    </div>

@endsection
