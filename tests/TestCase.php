<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Session;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function csrfToken(): string
    {
        Session::start();
        $token = csrf_token();
        Session::put('_token', $token);
        return $token;
    }
}
