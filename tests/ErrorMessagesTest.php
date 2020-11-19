<?php

namespace Cube\SilverStripe\Validation\Tests;

use Exception;
use SilverStripe\Dev\SapphireTest;
use Cube\SilverStripe\Validation\Validator;

/**
 * Class ErrorMessagesTest
 * @package Cube\SilverStripe\Validation\Tests
 */
class ErrorMessagesTest extends SapphireTest
{
    /**
     * @throws Exception
     */
    public function testErrorMessageExists()
    {
        $validator = Validator::make(
            [],
            ['Name' => 'required']
        );

        $validator->validate();

        $this->assertSame([
            'The Name is required.'
        ], $validator->errors()['Name']);
    }

    /**
     * @throws Exception
     */
    public function testCustomErrorMessage()
    {
        $validator = Validator::make(
            [],
            ['Name' => 'required']
        );

        $validator->setCustomMessages([
            'Name' => [
                'required' => 'This is a custom message'
            ]
        ]);

        $validator->validate();

        $this->assertEquals('This is a custom message', $validator->errors('Name')[0]);
    }
}
