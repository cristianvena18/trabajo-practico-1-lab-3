<?php


namespace Presentation\Http\Actions\TimeDeposit;


use App\Exceptions\InvalidBodyException;
use Application\Commands\TimeDeposit\CompoundTimeDepositQuery;
use Application\Commands\TimeDeposit\SimpleTimeDepositQuery;
use Application\Handlers\TimeDeposit\CompoundTimeDepositHandler;
use Application\Handlers\TimeDeposit\SimpleTimeDepositHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Infrastructure\CommandBus\CommandBusInterface;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\TimeDeposit\TimeDepositAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\TimeDeposit\CompoundTimeDepositPresenter;
use Presentation\Http\Presenters\TimeDeposit\SimpleTimeDepositPresenter;
use Presentation\Http\Presenters\TimeDeposit\TimeDepositPresenter;
use Psr\Http\Message\ServerRequestInterface;

final class TimeDepositAction
{
    public const VIEW = 'timeDeposit';

    private TimeDepositAdapter $adapter;

    private QueryBusInterface $queryBus;

    private TimeDepositPresenter $timeDepositPresenter;


    public function __construct(
        TimeDepositAdapter $adapter,
        QueryBusInterface $queryBus,
        TimeDepositPresenter $timeDepositPresenter
    )
    {
        $this->adapter = $adapter;
        $this->queryBus = $queryBus;
        $this->timeDepositPresenter = $timeDepositPresenter;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $data = $request->getParsedBody();
        try {
            $query = $this->adapter->from($data);

            $result = $this->queryBus->handle($query);

            return view(self::VIEW,
                [
                    'result' => implode($this->timeDepositPresenter
                        ->fromResult($result)
                        ->getData())
                ]
            );
        } catch (InvalidBodyException $e) {
            return redirect()->back()->withErrors($e->getMessages());
        }
    }
}
