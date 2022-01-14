let setOrderIdButton = document.querySelector(".set-order-id");
if (setOrderIdButton != null) {
    setOrderIdButton.addEventListener("click", function () {
        let orderId = "dummy" + (new Date().getTime()).toString();
        let id = this.dataset.bind;
        document.getElementById(id).value = orderId;
    })
}

let proceedPaymentButton = document.getElementById("proceed_payment");
if (proceedPaymentButton != null) {
    proceedPaymentButton.addEventListener("click", function () {
        var data = {};
        data.token_api_key = document.getElementById('token_api_key').value;
        if (document.getElementById('card_number')) {
            data.card_number = document.getElementById('card_number').value;
        }
        if (document.getElementById('cc_exp')) {
            data.card_expire = document.getElementById('cc_exp').value;
        }
        if (document.getElementById('cc_csc')) {
            data.security_code = document.getElementById('cc_csc').value;
        }
        if (document.getElementById('cardholderName')) {
            data.cardholder_name = document.getElementById('cardholderName').value;
        }

        data.lang = "ja";

        let url = "https://api.veritrans.co.jp/4gtoken";

        let xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Accept', 'application/json');
        xhr.setRequestHeader('Content-Type', 'application/json; charset=utf-8');
        xhr.addEventListener('loadend', function () {
            if (xhr.status === 0) {
                alert("トークンサーバーとの接続に失敗しました");
                return;
            }
            let response = JSON.parse(xhr.response);
            if (xhr.status === 200) {
                document.getElementById('card_number').value = "";
                document.getElementById('cc_exp').value = "";
                document.getElementById('cc_csc').value = "";
                if (document.getElementById('cardholderName')) {
                    document.getElementById('cardholderName').value = "";
                }
                document.getElementById('token').value = response.token;
                document.forms[0].submit();
            } else {
                alert(response.message);
            }
        });
        xhr.send(JSON.stringify(data));
    })
}
