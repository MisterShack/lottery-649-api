<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\ArrayShape;

class LotteryService
{
    public const BASE_URL = 'https://www.playnow.com/services2/lotto/draw/six49';

    #[ArrayShape(["drawNumbers" => "mixed", "bonusNumber" => "integer"])]
    private function getDrawDetails($date): array
    {
        $response = Http::get(self::BASE_URL . '/' . $date);

        return [
            "drawNumbers" => $response['drawNbrs'],
            "bonusNumber" => (int) $response['bonusNbr']
        ];
    }
}
