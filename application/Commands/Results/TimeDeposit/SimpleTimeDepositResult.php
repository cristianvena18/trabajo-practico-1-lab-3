<?php


namespace Application\Commands\Results\TimeDeposit;


use Infrastructure\CommandBus\ResultInterface;

class SimpleTimeDepositResult implements ResultInterface
{
    private string $fullName;
    private float $mount;
    private int $days;
    private int $interest;

    public function __construct(string $fullName, $mount, $days, $interest)
    {
        $this->fullName = $fullName;
        $this->mount = $mount;
        $this->days = $days;
        $this->interest = $interest;
    }

    public function getFullName(): string {
        return $this->fullName;
    }

    public function getMount(): float {
        return $this->mount;
    }

    public function getDays(): int {
        return $this->days;
    }

    public function getInterest(): int {
        return $this->interest;
    }
}
