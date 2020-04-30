<?php


namespace Application\Queries\Result\TimeDeposit;


use Domain\ValueObjects\TimeDeposit;
use Infrastructure\QueryBus\Result\ResultInterface;

class CompoundTimeDepositResult implements ResultInterface
{
    private string $fullName;
    private array $timeDeposits;
    private int $days;

    public function __construct(string $fullName, array $timeDeposits, int $days)
    {
        $this->fullName = $fullName;
        $this->timeDeposits = $timeDeposits;
        $this->days = $days;
    }

    public function getFullName(): string {
        return $this->fullName;
    }

    public function getTimeDeposits(): string {
        return implode($this->timeDeposits);
    }

    public function getDays(): int {
        return $this->days;
    }
}
