<?php


namespace Presentation\Http\Presenters\TimeDeposit;


class TimeDepositPresenter
{
    private $result;

    public function fromResult($result): TimeDepositPresenter {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        return [
            'fullName' => 'fullname: ' .  $this->result->getFullName(),
            'mount' => $this->result->getTimeDeposits(),
            'days' => ' days: ' . $this->result->getDays()
        ];
    }
}
