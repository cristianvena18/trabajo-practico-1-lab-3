<?php


namespace Presentation\Http\Actions\TimeDeposit;


use Illuminate\Http\Request;
use Illuminate\View\View;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Adapters\TimeDeposit\TimeDepositAdapter;
use Psr\Http\Message\ServerRequestInterface;

final class TimeDepositAction
{
    public const VIEW = 'timeDeposit';

    private TimeDepositAdapter $adapter;

    private CommandBusInterface $commandBus;

    private $presenterTimeDeposit;

    public function __construct(TimeDepositAdapter $adapter, CommandBusInterface $commandBus)
    {
        $this->adapter = $adapter;
        $this->commandBus = $commandBus;
    }

    public function __invoke(ServerRequestInterface $request): View
    {
        try {
            $data = $request->getParsedBody();
            $command = $this->adapter->from($data);

            $result = $this->commandBus->handle($command);

            return view(self::VIEW, $this->presenterTimeDeposit->fromResult($result)->getData());
        } catch (\Exception $exception) {
            return view('welcome');
        }
    }
}
