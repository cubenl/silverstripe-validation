<?php

namespace Cube\SilverStripe\Validation\Interfaces;

/**
 * Interface Rule
 * @package Cube\SilverStripe\Validation\Interfaces
 */
interface Rule
{
    /**
     * @param $value
     * @return bool
     */
    public function passes($value) : bool;
}
