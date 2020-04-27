<?php


namespace Application\Services\TimeDeposit;


use Domain\ValueObjects\TimeDeposit;

class TimeDepositService
{
    public function CalculateSimpleTimeDeposit(float $mount, int $days): TimeDeposit {
        $interest = $this->getPercentageFromCountDays($days);
        $mountWithInterest = $mount + ($mount * ($interest / 100) * $days / 360);

        return new TimeDeposit($mountWithInterest, $interest);
    }

    private function getPercentageFromCountDays(int $days): float {
        if($days < 60) {
            return 40;
        }
        else if ($days < 120) {
            return 45;
        }
        else if ($days < 360) {
            return 50;
        }
        else {
            return 60;
        }
    }
}
