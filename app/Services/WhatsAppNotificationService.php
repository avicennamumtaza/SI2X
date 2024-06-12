<?php

namespace App\Services;

use GuzzleHttp\Client;

class WhatsAppNotificationService
{
    protected $client;
    protected $apiUrl = 'https://api.fonnte.com/send'; // URL API Fonnte

    public function __construct()
    {
        $this->client = new Client();
    }

    public function sendWhatsAppMessage($phone, $message)
    {
        try {
            $response = $this->client->post($this->apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('BVC@6Jj62VKK3d6+xyS5'),
                ],
                'form_params' => [
                    'target' => $phone,
                    'message' => $message,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}