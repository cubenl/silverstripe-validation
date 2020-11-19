<?php

namespace Cube\SilverStripe\Validation\Tests\Stub;

use SilverStripe\Dev\TestOnly;
use SilverStripe\ORM\DataObject;
use Cube\SilverStripe\Validation\Interfaces\ValidationRules;

/**
 * Class Customer
 * @package Cube\SilverStripe\Validation\Tests\Stub
 */
class Customer extends DataObject implements TestOnly, ValidationRules
{
    /**
     * @var string[]
     */
    private static $db = [
        'Name' => 'Varchar(255)',
        'Company' => 'Varchar(255)'
    ];

    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'Name' => 'required',
            'Company' => 'required'
        ];
    }

    /**
     * @return string[][]
     */
    public function messages() : array
    {
        return [
            'Company' => [
                'required' => 'You need to work at a company.'
            ]
        ];
    }
}
