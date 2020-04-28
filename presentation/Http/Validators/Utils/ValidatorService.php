<?php


namespace Presentation\Http\Validators\Utils;


use Illuminate\Validation\Factory;

class ValidatorService implements ValidatorServiceInterface
{
    private $validatorFactory;
    private $validated;

    public function __construct(Factory $validatorFactory)
    {
        $this->validatorFactory = $validatorFactory;
    }

    public function make(array $options, array $rules)
    {
        $this->validated = $this->validatorFactory->make($options, $rules);
    }

    public function isValid(): bool
    {
        return !$this->validated->fails();
    }

    public function getErrors(): array
    {
        return $this->validated->errors()->toArray();
    }

    public function getValidator(){
        return $this->validated;
    }
}
