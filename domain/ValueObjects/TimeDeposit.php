<?php


namespace Domain\ValueObjects;


class TimeDeposit
{
    private float $mount;
    private int $interest;

    public function __construct(float $mount, int $interest)
    {
        $this->mount = $mount;
        $this->interest = $interest;
    }

    public function getMount(): float {
        return $this->mount;
    }

    public function getInterest(): int {
        return $this->interest;
    }

    public function __serialize(): array
    {
        return [
            'mount' => $this->mount,
            'interest' => $this->interest,
        ];
    }

    public function __toString()
    {
        return ' mount: ' . $this->mount . ', interest: ' . $this->interest;
    }
}
