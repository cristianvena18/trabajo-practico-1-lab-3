<?php


namespace Presentation\Http\Presenters\TimeDeposit;


use Application\Commands\Results\TimeDeposit\CompoundTimeDepositResult;

class CompoundTimeDepositPresenter
{
    private CompoundTimeDepositResult $result;

    public function fromResult(CompoundTimeDepositResult $result): CompoundTimeDepositPresenter
    {
        $this->result = $result;
        return $this;
    }

    public function getData(): array
    {
        return [
            'fullName' => $this->result->getFullName(),
            'mount' => array_get($this->result->getTimeDeposits(), 'mount'),
            'increment' => array_get($this->result->getTimeDeposits(), 'interest'),
            'days' => $this->result->getDays()
        ];
    }
}
