<?php


namespace Application\Queries\Query\TimeDeposit;


use Infrastructure\QueryBus\Query\QueryInterface;

class CompoundTimeDepositQuery implements QueryInterface
{
    private string $name;
    private string $surname;
    private float $mount;
    private int $days;

    public function __construct(string $name, string $surname, float $mount, int $days)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->mount = $mount;
        $this->days = $days;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function getMount(): float {
        return $this->mount;
    }

    public function getDays(): int {
        return $this->days;
    }
}
