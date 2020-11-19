<?php

namespace Cube\SilverStripe\Validation\Interfaces;

/**
 * Interface ValidationRules
 * @package Cube\SilverStripe\Validation\Interfaces
 */
interface ValidationRules
{
    /**
     * @return array
     */
    public function rules() : array;
}
