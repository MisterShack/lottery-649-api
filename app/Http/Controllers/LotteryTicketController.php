<?php

namespace App\Http\Controllers;

use App\Services\LotteryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

        $winningNumbers = LotteryService::getwinningNumbers($fields['draw_date']);

        return response($winningNumbers, 200);
    }
}
