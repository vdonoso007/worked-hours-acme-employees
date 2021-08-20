<?php

declare(strict_types=1);

namespace IOET\Acme\PayRoll\Employee\Domain\ValueObject;

use IOET\Acme\Shared\Domain\ValueObject\EnumDaysOfWeek;

final class EmployeeDayWorked extends EnumDaysOfWeek
{

    protected function availabledValues(): array
    {
        return [
            #Code               #Name of day
            'MO'        =>      'Monday',
            'TU'        =>      'Tuesday',
            'WE'        =>      'Wednesday',
            'TH'        =>      'Thursday',
            'FR'        =>      'Friday',
            'SA'        =>      'Satuday',
            'SU'        =>      'Sunday'
        ];
    }

    public function code() : string
    {
        return $this->key();
    }
    
    protected function validate(?string $external): void
    {
        if (!$this->isAvailabledKey($external)) throw new \Exception('Day of week not availabled');
    }
    
    public static function createFromCode(string $code): self
    {
        return self::createByKey($code);
    }
    
    public static function monday() : self
    {
        return self::createByKey('MO');
    }
    
    public static function tuesday() : self
    {
        return self::createByKey('TU');
    }
    
    public static function wednesday() : self
    {
        return self::createByKey('WE');
    }
    
    public static function thursday() : self
    {
        return self::createByKey('TH');
    }
    
    public static function friday() : self
    {
        return self::createByKey('FR');
    }
    
    public static function saturday() : self
    {
        return self::createByKey('SA');
    }
    
    public static function sunday() : self
    {
        return self::createByKey('SU');
    }
}