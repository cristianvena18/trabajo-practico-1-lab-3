<?php


namespace Application\Handlers\TimeDeposit;

use Application\Commands\Results\TimeDeposit\SimpleTimeDepositResult;
use Application\Services\TimeDeposit\TimeDepositService;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;
use Infrastructure\CommandBus\ResultInterface;

final class SimpleTimeDepositHandler implements HandlerInterface
{
    private TimeDepositService $timeDepositService;

    public function __construct(TimeDepositService $timeDepositService)
    {
        $this->timeDepositService = $timeDepositService;
    }

    public function handle($command): ResultInterface
    {
        $timeDeposit = $this->timeDepositService->CalculateSimpleTimeDeposit(
                                $command->getMount(),
                                $command->getDays());

        return new SimpleTimeDepositResult(
            $this->getFullNameFromCommand($command),
            $timeDeposit->getMount(),
            $command->getDays(),
            $timeDeposit->getInterest()
        );
    }

    private function getFullNameFromCommand(CommandInterface $command): string {
        $name = $command->getName();
        $surname = $command->getSurname();

        return "$name $surname";
    }
}
