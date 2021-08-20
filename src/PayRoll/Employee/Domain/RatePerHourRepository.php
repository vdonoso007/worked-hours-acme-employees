<?php

declare(strict_types = 1);

namespace IOET\Acme\PayRoll\Employee\Domain;

interface RatePerHourRepository {

    public static function get(): array;
}