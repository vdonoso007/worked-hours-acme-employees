<?php

declare(strict_types = 1);

namespace IOET\Acme\PayRoll\Employee\Infrastructure;

use IOET\Acme\PayRoll\Employee\Domain\RatePerHourRepository;

final class RateWorkedHoursRepository implements RatePerHourRepository
{

    public static function get(): array
    {
        return array(
            "MO" => [
                self::journal("dayOfWeek", "journal1", "00:01", "09:00", 25), 
                self::journal("dayOfWeek", "journal2", "09:01", "18:00", 15), 
                self::journal("dayOfWeek", "journal3", "18:01", "00:00", 20) 
            ], 
            "TU" => [
                self::journal("dayOfWeek", "journal1", "00:01", "09:00", 25), 
                self::journal("dayOfWeek", "journal2", "09:01", "18:00", 15), 
                self::journal("dayOfWeek", "journal3", "18:01", "00:00", 20) 
            ], 
            "WE" => [
                self::journal("dayOfWeek", "journal1", "00:01", "09:00", 25), 
                self::journal("dayOfWeek", "journal2", "09:01", "18:00", 15), 
                self::journal("dayOfWeek", "journal3", "18:01", "00:00", 20) 
            ], 
            "TH" => [
                self::journal("dayOfWeek", "journal1", "00:01", "09:00", 25), 
                self::journal("dayOfWeek", "journal2", "09:01", "18:00", 15), 
                self::journal("dayOfWeek", "journal3", "18:01", "00:00", 20) 
            ], 
            "FR" => [
                self::journal("dayOfWeek", "journal1", "00:01", "09:00", 25), 
                self::journal("dayOfWeek", "journal2", "09:01", "18:00", 15), 
                self::journal("dayOfWeek", "journal3", "18:01", "00:00", 20) 
            ],
            "SA" => [
                self::journal("weekend", "journal1", "00:01", "09:00", 30), 
                self::journal("weekend", "journal2", "09:01", "18:00", 20), 
                self::journal("weekend", "journal3", "18:01", "00:00", 25)
            ], 
            "SU" => [
                self::journal("weekend", "journal1", "00:01", "09:00", 30), 
                self::journal("weekend", "journal2", "09:01", "18:00", 20), 
                self::journal("weekend", "journal3", "18:01", "00:00", 25)
            ]
        );
    }

    private static function journal(string $type, string $journal, string $from, string $to, float $rate): array
    {
        return array(
            "type" => $type,
            "journal" => $journal,
            "from" => $from,
            "to" => $to,
            "rate" => $rate
        );
    }
}