<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    protected string $token;

    public function __construct()
    {
        $this->token = config('services.fonnte.token');
    }

    public function send(string $phone, string $message): bool
    {
        $phone = $this->normalize($phone);

        $response = Http::withHeaders([
            'Authorization' => $this->token,
        ])->post('https://api.fonnte.com/send', [
                    'target' => $phone,
                    'message' => $message,
                ]);

        return $response->successful();
    }

    private function normalize(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone);

        if (str_starts_with($phone, '0')) {
            return '62' . substr($phone, 1);
        }

        if (str_starts_with($phone, '62')) {
            return $phone;
        }

        return '62' . $phone;
    }
}