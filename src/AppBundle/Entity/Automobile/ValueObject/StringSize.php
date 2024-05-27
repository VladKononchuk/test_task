<?php

declare(strict_types=1);

namespace AppBundle\Entity\Automobile\ValueObject;

final class StringSize
{
    /**
     * @var string
     */
    public $value;

    public function __construct(
        string $value
    ) {
        if (mb_strlen($value) < 3 || mb_strlen($value) > 100) {
            throw new \InvalidArgumentException('Invalid string size');
        }

        $this->value = $value;
    }
}
