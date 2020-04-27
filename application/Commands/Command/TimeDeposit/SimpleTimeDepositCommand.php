<?php


namespace Application\Commands\Command\TimeDeposit;


use Infrastructure\CommandBus\Command\CommandInterface;

class SimpleTimeDepositCommand implements CommandInterface
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
