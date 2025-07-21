<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * URIs yang tidak akan diperiksa CSRF token-nya.
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/requests', // tambahkan endpoint React kamu di sini
    ];
}
