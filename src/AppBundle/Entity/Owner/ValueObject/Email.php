<?php

declare(strict_types=1);

namespace AppBundle\Entity\Owner\ValueObject;

final class Email
{
    public $value;

    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)
            || mb_strlen($value) < 3 || mb_strlen($value) > 50
        ) {
            throw new \InvalidArgumentException('Invalid email address');
        }

        $this->value = $value;
    }
}
