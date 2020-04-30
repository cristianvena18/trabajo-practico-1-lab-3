<?php


namespace Presentation\Http\Adapters\TimeDeposit;


use App\Exceptions\InvalidBodyException;
use Application\Queries\Query\TimeDeposit\CompoundTimeDepositQuery;
use Application\Queries\Query\TimeDeposit\SimpleTimeDepositQuery;
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
     * @return CompoundTimeDepositQuery|SimpleTimeDepositQuery
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
            return new CompoundTimeDepositQuery(
                array_get($request, 'name'),
                array_get($request, 'surname'),
                array_get($request,'mount'),
                array_get($request, 'days')
            );
        }
        else {
            return new SimpleTimeDepositQuery(
                array_get($request, 'name'),
                array_get($request, 'surname'),
                array_get($request,'mount'),
                array_get($request, 'days')
            );
        }
    }
}
