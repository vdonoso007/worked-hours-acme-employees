<?php

declare(strict_types=1);

namespace IOET\Acme\PayRoll\Employee\Domain;

use Exception;

final class FileNotFoundException extends Exception
{

    public function errorMessage()
    {
        return 'We are sorry... But file was not found';
    }
}