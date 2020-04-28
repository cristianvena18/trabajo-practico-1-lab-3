<?php


namespace Presentation\Http\Adapters\TimeDeposit;


use App\Exceptions\InvalidBodyException;
use Application\Commands\TimeDeposit\CompoundTimeDepositCommand;
use Application\Commands\TimeDeposit\SimpleTimeDepositCommand;
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

    /**
     * @param $request
     * @return CompoundTimeDepositCommand|SimpleTimeDepositCommand
     * @throws InvalidBodyException
     */
    public function from($request)
    {
        $this->validatorService->make($request, $this->schema->getRules());

        if(!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        $compound = array_get($request,'compound');

        if(isset($compound)) {
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
