<?php


namespace Presentation\Http\Adapters\TimeDeposit;


use Application\Commands\Command\TimeDeposit\CompoundTimeDepositCommand;
use Application\Commands\Command\TimeDeposit\SimpleTimeDepositCommand;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\Command\CommandInterface;
use Presentation\Http\Validators\Schemas\TimeDepositSchema;
use Presentation\Http\Validators\Utils\ValidatorServiceInterface;

class TimeDepositAdapter
{
    private ValidatorServiceInterface $validatorService;
    private TimeDepositSchema $schema;

    public function __construct(ValidatorServiceInterface $validatorService, TimeDepositSchema $schema)
    {
        $this->validatorService = $validatorService;
        $this->schema = $schema;
    }

    public function from($request)
    {
        $this->validatorService->make($request, $this->schema->getRules());

        $compound = array_get($request,'compound');

        if($compound){
            return new CompoundTimeDepositCommand(
                array_get($request, 'name'),
                array_get($request, 'surname'),
                array_get($request,'mount'),
                array_get($request, 'days')
            );
        }
        else {
            return new SimpleTimeDepositCommand(
                array_get($request, 'name'),
                array_get($request, 'surname'),
                array_get($request,'mount'),
                array_get($request, 'days')
            );
        }
    }
}
