<?php


namespace Application\Commands\Results\TimeDeposit;


use Domain\ValueObjects\TimeDeposit;
use Infrastructure\CommandBus\ResultInterface;

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

    public function getTimeDeposits(): array {
        return $this->timeDeposits;
    }

    public function getDays(): int {
        return $this->days;
    }
}
