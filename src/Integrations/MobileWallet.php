<?php

namespace ctf0\PayMob\Integrations;

use Illuminate\Support\Facades\Http;

class MobileWallet extends Accept
{
    public function getPaymentTypeName(): string
    {
        return 'mobile_wallet';
    }

    /**
     * finish checkout process.
     *
     * https://acceptdocs.paymobsolutions.com/docs/mobile-wallets
     *
     * @param float|int $total
     * @param array     $items
     */
    public function checkOut($total, $items = [])
    {
        $this->checkForMinAmount($total);

        $url      = $this->getConfigKey($this->getPaymentTypeConfig('url'));
        $order_id = $this->orderRegistration($items, $total);
        $payment_token = $this->paymentKeyRequest($order_id, $total);

        $response = Http::withToken($this->auth_token)
            ->post($url, [
                'source' => [
                    'identifier' => $this->user->phone_number,
                    'subtype'    => 'WALLET',
                ],
                'payment_token' => $payment_token,
            ])
            ->throw();

        if (!$response['redirect_url']) {
            abort(417, __('paymob::messages.url_required'));
        }

        return [
            'url' => $response['redirect_url'],
            'order_id' => $order_id,
            'payment_token' => $payment_token,
        ];
    }
}
