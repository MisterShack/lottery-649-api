<?php

namespace App\ValueObjects;

use InvalidArgumentException;

class LotteryTicket
{
    private string $date;

    private array $ticketNumbers;

    private int $bonusNumber;

    public function __construct($date, $ticketNumbers, $bonusNumber)
    {
        $this->setDate($date);
        $this->setTicketNumbers($ticketNumbers);
        $this->setBonusNumber($bonusNumber);
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setTicketNumbers(array $ticketNumbers): void
    {
        if (count($ticketNumbers) !== 6) {
            throw new InvalidArgumentException(
                "\$ticketNumbers should be 6 digits long"
            );
        }

        $this->ticketNumbers = $ticketNumbers;
    }

    public function getTicketNumbers(): array
    {
        return $this->ticketNumbers;
    }

    public function setBonusNumber(int $bonusNumber): void
    {
        $this->bonusNumber = $bonusNumber;
    }

    public function getBonusNumber(): int
    {
        return $this->bonusNumber;
    }
}
