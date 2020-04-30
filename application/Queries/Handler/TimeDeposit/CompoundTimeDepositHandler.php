<?php


namespace Application\Queries\Handler\TimeDeposit;


use Application\Queries\Result\TimeDeposit\CompoundTimeDepositResult;
use Application\Services\TimeDeposit\TimeDepositService;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;


class CompoundTimeDepositHandler implements HandlerInterface
{
    private TimeDepositService $timeDepositService;

    public function __construct(TimeDepositService $timeDepositService)
    {
        $this->timeDepositService = $timeDepositService;
    }

    /**
     * @param QueryInterface $command
     * @return ResultInterface
     */
    public function handle($command): ResultInterface
    {
        $days = $command->getDays();

        $timeDeposits = [$this->timeDepositService->CalculateSimpleTimeDeposit(
            $command->getMount(),
            $days)];

        for ($i = 1; $i < 4; $i++) {
            $timeDeposits[] = $this->timeDepositService->CalculateSimpleTimeDeposit(
                                        $timeDeposits[$i-1]->getMount(),
                                        $days);
        }

        return new CompoundTimeDepositResult(
            $this->getFullNameFromCommand($command),
            $timeDeposits,
            $command->getDays()
        );
    }

    private function getFullNameFromCommand($command): string {
        $name = $command->getName();
        $surname = $command->getSurname();

        return "$name $surname";
    }
}
