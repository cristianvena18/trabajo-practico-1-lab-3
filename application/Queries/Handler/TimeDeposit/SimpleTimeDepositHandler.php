<?php


namespace Application\Queries\Handler\TimeDeposit;

use Application\Queries\Result\TimeDeposit\SimpleTimeDepositResult;
use Application\Services\TimeDeposit\TimeDepositService;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

final class SimpleTimeDepositHandler implements HandlerInterface
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
        $timeDeposit = $this->timeDepositService->CalculateSimpleTimeDeposit(
                                $command->getMount(),
                                $command->getDays());

        return new SimpleTimeDepositResult(
            $this->getFullNameFromCommand($command),
            $timeDeposit,
            $command->getDays(),
        );
    }

    private function getFullNameFromCommand($command): string {
        $name = $command->getName();
        $surname = $command->getSurname();

        return "$name $surname";
    }
}
