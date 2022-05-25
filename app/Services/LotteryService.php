<?php

namespace App\Services;

use App\ValueObjects\LotteryTicket;
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

    public function checkTicket(LotteryTicket $ticket): float
    {
        $drawDetails = $this->getDrawDetails($ticket->getDate());

        $drawNumberMatches = $this->compareWinningNumbersToTicket($drawDetails['drawNumbers'], $ticket->getTicketNumbers());

        $hasBonus = $drawDetails['bonusNumber'] === $ticket->getBonusNumber();


        return $this->getPrizeAmount($drawNumberMatches, $hasBonus);
    }

    private function getPrizeAmount($matchingNumberCount, $hasBonus): float
    {
        $prizeAmount = 0;

        $prizeStructure = [
            "6/6" => 6000000,
            "5/6+" => 101390.80,
            "5/6" => 2414.10,
            "4/6" => 82.50,
            "3/6" => 10.00,
            "2/6+" => 5.00,
            "2/6" => 3.00,
        ];

        if ($hasBonus && in_array($matchingNumberCount, [2, 5], true)) {
            $prizeAmount = $prizeStructure[$matchingNumberCount . "/6+"];
        } else if ($matchingNumberCount > 1) {
            $prizeAmount = $prizeStructure[$matchingNumberCount . "/6"];
        }

        return $prizeAmount;
    }

    private function compareWinningNumbersToTicket(array $winningNumbers, array $ticketNumbers): int
    {
        $numberOfMatches = 0;

        foreach ($winningNumbers as $winningNumber) {
            if (in_array($winningNumber, $ticketNumbers, true)) {
                $numberOfMatches++;
            }
        }

        return $numberOfMatches;
    }
}
