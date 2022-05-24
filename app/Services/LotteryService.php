<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\ArrayShape;

class LotteryService
{
    public const BASE_URL = 'https://www.playnow.com/services2/lotto/draw/six49';

    #[ArrayShape(["drawNumbers" => "mixed", "bonusNumber" => "mixed", "extraNumbers" => "mixed"])]
    public static function getWinningNumbers($date): array
    {
        $response = Http::get(self::BASE_URL . '/' . $date);

        return [
            "drawNumbers" => $response['drawNbrs'],
            "bonusNumber" => $response['bonusNbr'],
            "extraNumbers" => $response['extraNbrs'],
        ];
    }
}
