<?php


namespace Presentation\Http\Validators\Utils;


interface ValidatorServiceInterface
{
    public function make(array $options, array $rules);

    public function isValid(): bool;

    public function getErrors(): array;
}
