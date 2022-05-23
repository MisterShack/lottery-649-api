<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class LotteryTicketController extends Controller
{
    public function checkTicket(Request $request): Response
    {
        $fields = $request->validate([
            'draw_date' => 'required|date_format:Y-m-d',
            'numbers' => 'required',
            'extra' => 'integer|size:7'
        ]);

        if (!is_array($fields['numbers']) || count($fields['numbers']) !== 7) {
            return response([
                'message' => 'Invalid numbers parameter.'
            ], 500);
        }

        $response = Http::get('https://www.playnow.com/services2/lotto/draw/six49/' . $fields['draw_date'], ['verify' => base_path('cacert.pem')]);

        $drawNumbers = $response['drawNbrs'];
        $bonusNumber = $response['bonusNbr'];
        $extraNumbers = $response['extraNbrs'];





        return response($response->json(), 200);
    }
}
