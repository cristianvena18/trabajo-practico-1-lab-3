<?php


namespace Infrastructure\CommandBus\Handler;


use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\ResultInterface;

interface HandlerInterface
{
    public function handle(CommandInterface $command): ResultInterface;
}
