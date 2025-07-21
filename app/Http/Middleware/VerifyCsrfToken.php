<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{

    protected $except = [
        '/telegram/webhook',
    ];
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
}
