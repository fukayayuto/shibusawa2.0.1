<?php

namespace App\Http\Controllers;

use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;
use tgMdk\dto\CvsAuthorizeRequestDto;
use tgMdk\dto\CvsAuthorizeResponseDto;
use tgMdk\TGMDK_Logger;
use tgMdk\TGMDK_Transaction;

class CvsController extends Controller
{
    public function index()
    {
        return view('cvs/index')->with(
            [
                "amount" => "100",
                "orderId" => Helpers::generateOrderId()
            ]);
    }

    public function cvsAuthorize(Request $request)
    {

        $logger = Log::channel('tgmdk')->getLogger();
        if ($logger instanceof LoggerInterface) {
            TGMDK_Logger::setLogger($logger);
        }

        $request_data = new CvsAuthorizeRequestDto();
        $request_data->setServiceOptionType($request->request->get("serviceOptionType"));
        $request_data->setAmount($request->request->get("amount"));
        $request_data->setOrderId($request->request->get("orderId"));
        $request_data->setName1($request->request->get("name1"));
        $request_data->setName2($request->request->get("name2"));
        $request_data->setTelNo($request->request->get("telNo"));
        $request_data->setPayLimit($request->request->get("payLimit"));
        $request_data->setPayLimitHhmm($request->request->get("payLimitHhmm"));
        $request_data->setPushUrl($request->request->get("pushUrl"));
        $request_data->setPaymentType("0");

        $transaction = new TGMDK_Transaction();
        $response_data = $transaction->execute($request_data);

        if ($response_data instanceof CvsAuthorizeResponseDto) {
            $request->session()->put($request->request->get("orderId"), $response_data);
            return redirect()->action('CvsController@authorizeResult', ['orderId' => $request->request->get("orderId")]);
        }

        return view('cvs/index')->with(
            [
                'amount' => $request->request->get("amount")
            ]);

    }

    public function authorizeResult($orderId)
    {
        $response_data = session($orderId);
        if ($response_data instanceof CvsAuthorizeResponseDto) {
            return view('cvs/result')->with([
                'mstatus' => $response_data->getMstatus(),
                'vResultCode' => $response_data->getVResultCode(),
                'mErrMsg' => $response_data->getMerrMsg(),
                'orderId' => $response_data->getOrderId(),
                'receiptNo' => $response_data->getReceiptNo(),
                'haraikomiUrl' => $response_data->getHaraikomiUrl(),
            ]);
        } else {
            return view('cvs/result')->with([
                'mstatus' => null, 'vResultCode' => null, 'mErrMsg' => null, 'orderId' => null, 'receiptNo' => null,
                'haraikomiUrl' => null, 'message' => "error!"
            ]);
        }
    }

}
