<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PayUService
{
    use ConsumesExternalServices;

    protected $baseUri;
    protected $key;
    protected $secret;
    protected $merchantId;
    protected $accountId;

    public function __construct()
    {
        $this->baseUri = config('services.payu.base_uri');
        $this->key = config('services.payu.key');
        $this->secret = config('services.payu.secret');
        $this->merchantId = config('services.payu.merchant_id');
        $this->accountId = config('services.payu.account_id');
    }
    
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $formParams['merchant']['apiKey'] = $this->key;
        $formParams['merchant']['apiLogin'] = $this->secret;
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function handlePayment(Request $request)
    {
        $request->validate([
            'payu_card' => 'required',
            'payu_cvc' => 'required',
            'payu_year' => 'required',
            'payu_month' => 'required',
            'payu_network' => 'required',
            'payu_name' => 'required',
            'payu_email' => 'required',
        ]);

        $payment = $this->createPayment(
            $request->value,
            'COP',
            $request->payu_name,
            $request->payu_email,
            $request->payu_card,
            $request->payu_cvc,
            $request->payu_year,
            $request->payu_month,
            $request->payu_network,
        );

        if ($payment->transactionResponse->state === "APPROVED") {
            $name = $request->payu_name;
            $amount = $request->value;
            $currency = 'COP';

            return response()->json([
                'message' => "Gracias, {$name}. Hemos recibido su pago por un monto de: {$amount}{$currency}.",
                'payment' => $payment
            ], 201);
        }

        return response()->json([
            'error' => 'We were unable to process your payment. Check your details and try again, please.'
        ], 422);
    }

    public function handleApproval(Request $request)
    {
        // Verificar el estado del pago con PayU usando la referencia del pago
        $reference = $request->input('reference');
        
        $payment = $this->checkPaymentStatus($reference);
    
        if ($payment->transactionResponse->state === "APPROVED") {
            // Actualizar el estado del pago en tu base de datos
            // $this->updatePaymentStatus($reference, 'approved');
            return response()->json(['message' => 'Payment approved', 'payment' => $payment], 200);
        }
    
        return response()->json(['error' => 'Payment not approved'], 422);
    }
    
    public function checkPaymentStatus($reference)
    {
        return $this->makeRequest(
            'POST',
            '/payments-api/4.0/service.cgi',
            [],
            [
                'language' => config('app.locale'),
                'command' => 'GET_PAYMENT_STATE',
                'merchant' => [
                    'apiKey' => $this->key,
                    'apiLogin' => $this->secret,
                ],
                'transaction' => [
                    'order' => [
                        'referenceCode' => $reference,
                    ],
                ],
                'test' => false
            ],
            [
                'Accept' => 'application/json',
            ],
            true
        );
    }
    
    public function createPayment($value, $currency, $name, $email, $card, $cvc, $year, $month, $network, $installments = 1, $paymentCountry = 'CL')
    {
        return $this->makeRequest(
            'POST',
            '/payments-api/4.0/service.cgi',
            [],
            [
                'language' => config('app.locale'),
                'command' => 'SUBMIT_TRANSACTION',
                'transaction'=> [
                    'order'=> [
                        'accountId'=> $this->accountId,
                        'referenceCode'=> $reference = Str::random(12),
                        'description'=> "Testing test",
                        'language'=> config('app.locale'),
                        'signature'=> $this->generateSignature($reference, round($value)),
                        'additionalValues'=> [
                            'TX_VALUE'=> [
                                'value'=> $value,
                                'currency'=> 'COP',
                            ]
                        ],
                        'buyer'=> [
                            'fullName'=> $name,
                            'emailAddress'=> $email,
                            'shippingAddress'=> [
                                'street1'=> '',
                                'street2'=> '',
                                'city'=> '',
                                'state'=> '',
                                'country'=> $paymentCountry,
                                'postalCode'=> '',
                                'phone'=> ''
                            ]
                        ],
                        'shippingAddress'=> [
                            'street1'=> '',
                            'street2'=> '',
                            'city'=> '',
                            'state'=> '',
                            'country'=> $paymentCountry,
                            'postalCode'=> '',
                            'phone'=> ''
                        ]
                    ],
                    'payer'=> [
                        'billingAddress'=> [
                            'street1'=> '',
                            'street2'=> '',
                            'city'=> '',
                            'state'=> '',
                            'country'=> $paymentCountry,
                            'postalCode'=> '',
                            'phone'=> ''
                        ]
                    ],
                    'creditCard'=> [
                        'number'=> $card,
                        'securityCode'=> $cvc,
                        'expirationDate'=> "{$year}/{$month}",
                        'name'=> 'REJECTED'
                    ],
                    'extraParameters'=> [
                        'INSTALLMENTS_NUMBER'=> $installments
                    ],
                    'type'=> 'AUTHORIZATION_AND_CAPTURE',
                    'paymentMethod'=> strtoupper($network),
                    'paymentCountry'=> strtoupper($paymentCountry),
                    'deviceSessionId'=> session()->getId(),
                    'ipAddress'=> request()->ip(),
                    'cookie'=> 'pt1t38347bs6jc9ruv2ecpv7o2',
                    'userAgent'=> request()->header('User-Agent')
                ],
                'test' => false
            ],
            [
                'Accept' => 'application/json',
            ],
            true
        );
    }

    public function generateSignature($referenceCode, $value)
    {
        return md5("{$this->key}~{$this->merchantId}~{$referenceCode}~{$value}~COP");
    }
}
