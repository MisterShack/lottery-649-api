<?php

namespace App\Http\Controllers;

use App\Services\LotteryService;
use App\ValueObjects\LotteryTicket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class LotteryTicketController extends Controller
{
    public function checkTicket(Request $request): Response
    {
        $fields = $request->validate([
            'draw_date' => 'required|date_format:Y-m-d',
            'ticket_numbers' => 'required',
            'ticket_bonus' => 'required|integer'
        ]);

        try {
            $ticket = new LotteryTicket($fields['draw_date'], $fields['ticket_numbers'], $fields['ticket_bonus']);

        } catch (InvalidArgumentException $e) {
            return response([
                'message' => "Invalid parameters"
            ], 500);
        }

        $lotteryTicketService = new LotteryService();

        return response([
            "winning_amount" => $lotteryTicketService->checkTicket($ticket)
        ], 200);
    }
}
