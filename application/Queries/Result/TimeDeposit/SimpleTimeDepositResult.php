<?php


namespace Application\Queries\Result\TimeDeposit;


use Domain\ValueObjects\TimeDeposit;
use Infrastructure\QueryBus\Result\ResultInterface;

class SimpleTimeDepositResult implements ResultInterface
{
    private string $fullName;
    private TimeDeposit $timeDeposit;
    private int $days;

    public function __construct(string $fullName, $timeDeposit, $days)
    {
        $this->fullName = $fullName;
        $this->timeDeposit = $timeDeposit;
        $this->days = $days;
    }

    public function getFullName(): string {
        return $this->fullName;
    }

    public function getTimeDeposits(): string {
        return $this->timeDeposit;
    }

    public function getDays(): int {
        return $this->days;
    }
}
