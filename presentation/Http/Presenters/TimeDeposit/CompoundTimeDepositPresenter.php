<?php


namespace Presentation\Http\Presenters\TimeDeposit;


use Infrastructure\CommandBus\ResultInterface;

class CompoundTimeDepositPresenter
{
    private ResultInterface $result;

    public function fromResult(ResultInterface $result): CompoundTimeDepositPresenter
    {
        $this->result = $result;
        return $this;
    }

    public function getData(): array
    {
        return [
            'fullName' => 'fullname: ' .  $this->result->getFullName(),
            'mount' => $this->result->getTimeDeposits(),
            'days' => ' days: ' . $this->result->getDays()
        ];
    }
}
