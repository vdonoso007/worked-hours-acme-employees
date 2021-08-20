<?php

declare(strict_types = 1);

namespace IOET\Acme\PayRoll\Employee\Application\GetRateByWorkedHoursReported;

use IOET\Acme\PayRoll\Employee\Domain\RatePerHourRepository;

final class RateByWorkedHoursReportedGetter
{

    private RatePerHourRepository $ratePerHourRepository;

    public function __construct(RatePerHourRepository $ratePerHourRepository)
    {
        $this->ratePerHourRepository = $ratePerHourRepository;
    }

    public function __invoke(string $day, string $from, string $to)
    {
        $rates = $this->ratePerHourRepository->get();
        $journals = array_filter($rates, function($dayKey) use($day){
            return $dayKey == $day;
        }, ARRAY_FILTER_USE_KEY);
        $rate = $this->searchRateByReport($journals[$day], [$from, $to]);
        return $rate;
    }

    private function searchRateByReport(array $journals, array $range): array
    {
        $fromTimeReported = $this->convertToDateTime($range[0]);
        $toTimeReported = $this->convertToDateTime($range[1]);

        foreach( $journals as $journal)
        {
            if ( $fromTimeReported >= $this->convertToDateTime($journal['from']) && $fromTimeReported <= $this->convertToDateTime($journal['to']) &&
                 $toTimeReported >= $this->convertToDateTime($journal['from']) && $toTimeReported <= $this->convertToDateTime($journal['to'])
            )
            {
                $workedHoursQuantities = (abs($toTimeReported - $fromTimeReported))/(60*60);
                return [
                    "rate" => $journal['rate'],
                    "workedHours" => $workedHoursQuantities,
                    "journal" => $journal['journal']=="journal1" ? 1 : ($journal['journal']=="journal2" ? 2 :3),
                    "typeOfDay" => $journal['type']=="dayOfWeek"?0:1
                ];
            }
        }
        return [];
    }

    private function convertToDateTime(string $shortTime)
    {
        return strtotime("2021-08-16 ".$shortTime);
    }
}