<?php


namespace Presentation\Http\Presenters\TimeDeposit;

use Infrastructure\CommandBus\ResultInterface;

class SimpleTimeDepositPresenter
{
    private ResultInterface $result;

    public function fromResult(ResultInterface $result): SimpleTimeDepositPresenter
    {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        return [
            'fullName' => $this->result->getFullName(),
            'mount' => $this->result->getMount(),
            'interest' => $this->result->getInterest(),
            'days' => $this->result->getDays()
        ];
    }
}
