<?php


namespace Presentation\Http\Presenters\TimeDeposit;


use Application\Commands\Results\TimeDeposit\SimpleTimeDepositResult;

class SimpleTimeDepositPresenter
{
    private SimpleTimeDepositResult $result;

    public function fromResult(SimpleTimeDepositResult $result): SimpleTimeDepositPresenter
    {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        return [
            'fullName' => $this->result->getFullName(),
            'mount' => array_get($this->result->getTimeDeposits(), 'mount'),
            'increment' => array_get($this->result->getTimeDeposits(), 'interest'),
            'days' => $this->result->getDays()
        ];
    }
}
