<?php


namespace Application\Commands\Handler\TimeDeposit;


use Application\Commands\Results\TimeDeposit\CompoundTimeDepositResult;
use Application\Commands\Results\TimeDeposit\SimpleTimeDepositResult;
use Application\Services\TimeDeposit\TimeDepositService;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;
use Infrastructure\CommandBus\ResultInterface;

class CompoundTimeDepositHandler implements HandlerInterface
{
    private TimeDepositService $timeDepositService;

    public function __construct(TimeDepositService $timeDepositService)
    {
        $this->timeDepositService = $timeDepositService;
    }

    public function handle($command): ResultInterface
    {
        $days = $command->getDays();

        $timeDeposits[] = $this->timeDepositService->CalculateSimpleTimeDeposit(
            $command->getMount(),
            $days);

        for ($i = 0; $i < 3; $i++) {
            $timeDeposits[] = $this->timeDepositService->CalculateSimpleTimeDeposit(
                                        $timeDeposits[$i]->getMount(),
                                        $days);
        }

        return new CompoundTimeDepositResult(
            $this->getFullNameFromCommand($command),
            $timeDeposits,
            $command->getDays()
        );
    }

    private function getFullNameFromCommand(CommandInterface $command): string {
        $name = $command->getName();
        $surname = $command->getSurname();

        return "$name $surname";
    }
}
