<?php

namespace Modules\Auth\App\Services;

class VerifyEmailService
{
    public function message($status, $message = false): array
    {
        return $this->{$status . 'Message'}($message);
    }

    protected function successMessage($message = false): array
    {
        return [
            'status' => 'success',
            'message' => $message ?: 'لینک تایید برای ایمیل شما ارسال شد.'
        ];
    }

    protected function infoMessage($message = false): array
    {
        return [
            'status' => 'info',
            'message' => $message ?: 'ایمیل شما قبلا تایید شده است!'
        ];
    }
}
