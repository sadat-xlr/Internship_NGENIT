<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/order-success',
        '/order-failed',
        '/order-cancle',
        '/pre-order-success',
        '/pre-order-failed',
        '/pre-order-cancle',
        '/pre-order-remaining-payment-success',
    ];
}
