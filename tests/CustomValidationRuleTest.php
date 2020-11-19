<?php

namespace Cube\SilverStripe\Validation\Tests;

use Exception;
use SilverStripe\Dev\SapphireTest;
use Cube\SilverStripe\Validation\Validator;

/**
 * Class CustomValidationRuleTest
 * @package Cube\SilverStripe\Validation\Tests
 */
class CustomValidationRuleTest extends SapphireTest
{
    /**
     * @throws Exception
     */
    public function testValidationRuleExists()
    {
        $validator = Validator::make([
            'Name' => 'JOHN'
        ], ['Name' => 'uppercase']);

        $this->assertTrue($validator->validate());
    }

    /**
     * @throws Exception
     */
    public function testValidationRuleDoesNotExists()
    {
        $validator = Validator::make([
            'Name' => 'John'
        ], ['Name' => 'non-existing-rule']);

        $this->expectException(Exception::class);

        $validator->validate();
    }
}
