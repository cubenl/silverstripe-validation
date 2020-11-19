<?php

namespace Cube\SilverStripe\Validation\Tests\Stub;

use Cube\SilverStripe\Validation\Interfaces\Rule;

/**
 * Class UpperCase
 * @package Cube\SilverStripe\Validation\Tests\Stub
 */
class UpperCase implements Rule
{
    /**
     * @var string
     */
    public static $name = 'uppercase';

    /**
     * @param $value
     * @return bool
     */
    public function passes($value): bool
    {
        return strtoupper($value) === $value;
    }
}
