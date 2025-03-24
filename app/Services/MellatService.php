<?php

namespace App\Services;

class MellatService
{
    const PAY_URL = 'https://bpm.shaparak.ir/pgwchannel/startpay.mellat';

    public function sendPaymentRequest(int $amount, int $orderId, int $payerId): array
    {
        return [];
        // $data = [
        //     'terminalId' => config('services.mellat.terminal_id'),
        //     'userName' => config('services.mellat.username'),
        //     'userPassword' => config('services.mellat.password'),
        //     'orderId' => $orderId,
        //     'amount' => $amount,
        //     'localDate' => date('Ymd'),
        //     'localTime' => date('Gis'),
        //     'additionalData' => '',
        //     'callBackUrl' => route('mellat.callback'),
        //     'payerId' => $payerId,
        // ];

        // $client = new SoapClient(config('services.mellat.wsdl_url'), [
        //     'trace' => 1,
        //     'exceptions' => true,
        //     'soap_version' => SOAP_1_1,
        //     'encoding' => 'UTF-8',
        // ]);

        // $result = $client->bpPayRequest($data);

        // if (! $result) {
        //     throw new Exception('Payment request failed');
        // }

        // $exploded = explode(',', $result);

        // if ($exploded[0] !== '0') {
        //     return ['statusCode' => (int) $exploded[0], 'refId' => $exploded[1] ?? null];
        // }

        // return ['statusCode' => $exploded[0], 'refId' => $exploded[1]];
    }
}
