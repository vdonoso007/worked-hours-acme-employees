<?php

declare(strict_types=1);

namespace IOET\Acme\Shared\Domain\ValueObject;

abstract class EnumDaysOfWeek
{
    protected string $key;
    
    abstract protected function availabledValues (): array;
    abstract protected function validate (?string $key): void;

    protected function __construct(?string $key)
    {
        $this->validate($key);

        $this->key = $key;
    }
    
    public static function createByKey(string $key): self
    {
        $class = get_called_class();
        
        return new $class($key);
    }
    
    protected function isAvailabledKey(string $key): bool
    {
        $availabedValues = $this->availabledValues();
        
        return (array_key_exists($key, $availabedValues));
    }

    public function value()
    {
        if (is_null($this->key)) return null;
        
        return $this->availabledValues()[$this->key];
    }
    
    public function key(): string
    {
        return $this->key;
    }
}
