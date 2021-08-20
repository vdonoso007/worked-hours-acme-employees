<?php

declare(strict_types = 1);

namespace IOET\Acme\Shared\Domain\ValueObject;

use LengthException;

abstract class StringValueObject
{
    protected $value;

    public function __construct(string $value, int $maxLength = null, int $minLength = null)
    {
        if (!empty($maxLength)) $this->validateMaxLength($maxLength, $value);
        
        if (!empty($minLength)) $this->validateMinLength($minLength, $value);
        
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
    
    protected function validateMaxLength(int $maxLength, string $value) {
        if (mb_strlen($value) > $maxLength) 
            throw new LengthException(sprintf('%s value exceeds the maximum of %d characters', static::class, $maxLength));
    }
    
    protected function validateMinLength(int $minLength, string $value) {
        if (mb_strlen($value) < $minLength) 
            throw new LengthException(sprintf('%s value must be a minimum of %d characters', static::class, $minLength));
    }

    public function __toString()
    {
        return $this->value();
    }
    
    public function equal(self $otherString) : bool
    {
        return ($this->value() === $otherString->value());
    }
}