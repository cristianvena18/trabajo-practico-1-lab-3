<?php


namespace Presentation\Http\Actions\TimeDeposit;


use App\Exceptions\InvalidBodyException;
use Application\Commands\TimeDeposit\CompoundTimeDepositCommand;
use Application\Commands\TimeDeposit\SimpleTimeDepositCommand;
use Application\Handlers\TimeDeposit\CompoundTimeDepositHandler;
use Application\Handlers\TimeDeposit\SimpleTimeDepositHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Adapters\TimeDeposit\TimeDepositAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\TimeDeposit\CompoundTimeDepositPresenter;
use Presentation\Http\Presenters\TimeDeposit\SimpleTimeDepositPresenter;
use Psr\Http\Message\ServerRequestInterface;

final class TimeDepositAction
{
    public const VIEW = 'timeDeposit';

    private TimeDepositAdapter $adapter;

    private SimpleTimeDepositHandler $simpleTimeDepositHandler;

    private CompoundTimeDepositHandler $compoundTimeDepositHandle;

    private SimpleTimeDepositPresenter $simplePresenterTimeDeposit;

    private CompoundTimeDepositPresenter $compoundPresenterTimeDeposit;

    public function __construct(
        TimeDepositAdapter $adapter,
        SimpleTimeDepositHandler $simpleTimeDepositHandler,
        CompoundTimeDepositHandler $compoundTimeDepositHandler,
        SimpleTimeDepositPresenter $simplePresenterTimeDeposit,
        CompoundTimeDepositPresenter $compoundPresenterTimeDeposit
    )
    {
        $this->adapter = $adapter;
        $this->simpleTimeDepositHandler = $simpleTimeDepositHandler;
        $this->compoundTimeDepositHandle = $compoundTimeDepositHandler;
        $this->simplePresenterTimeDeposit = $simplePresenterTimeDeposit;
        $this->compoundPresenterTimeDeposit = $compoundPresenterTimeDeposit;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $data = $request->getParsedBody();
        try {
            $command = $this->adapter->from($data);

            $result = $this->resolverCommandHandle($command);
        } catch (InvalidBodyException $e) {
            return redirect()->back()->withErrors($e->getMessages());
        }
        return view(self::VIEW, ['result' => implode($result)]);
    }

    private function resolverCommandHandle($command)
    {
        if($command instanceof SimpleTimeDepositCommand)
        {
            $result = $this->simpleTimeDepositHandler->handle($command);
            return $this->simplePresenterTimeDeposit->fromResult($result)->getData();
        }
        else if($command instanceof CompoundTimeDepositCommand)
        {
            $result = $this->compoundTimeDepositHandle->handle($command);
            return $this->compoundPresenterTimeDeposit->fromResult($result)->getData();
        }
        throw new \Exception("not found type command");
    }
}
