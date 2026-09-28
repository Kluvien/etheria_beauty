<?php

namespace App\Support;

class WhatsApp
{
    public static function url(string $message = ''): string
    {
        $number = preg_replace('/\D+/', '', config('etheria.whatsapp'));
        $number = str_starts_with($number, '0') ? '62'.substr($number, 1) : $number;

        return 'https://wa.me/'.$number.($message !== '' ? '?text='.rawurlencode($message) : '');
    }

    public static function bookingMessage(array $values = []): string
    {
        return "Hello Etheria Beauty, I would like to make an appointment.\n\n"
            .'Name: '.($values['name'] ?? '')."\n"
            .'Service: '.($values['service'] ?? '')."\n"
            .'Date: '.($values['date'] ?? '')."\n"
            .'Time: '.($values['time'] ?? '')."\n\n"
            .'Please confirm my appointment. Thank you.';
    }
}