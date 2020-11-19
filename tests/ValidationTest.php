<?php

namespace Cube\SilverStripe\Validation\Tests;

use Exception;
use SilverStripe\Dev\SapphireTest;
use Cube\SilverStripe\Validation\Validator;


/**
 * Class ValidationTest
 * @package Cube\SilverStripe\Validation\Tests
 */
class ValidationTest extends SapphireTest
{
    /**
     * Test the validator with a rule that does not exists
     */
    public function testRuleDoesNotExists()
    {
        $validator = Validator::make([
            'Name' => 'John'
        ], ['Name' => 'this_does_not_exist']);

        $this->expectException(Exception::class);

        $validator->validate();
    }

    /**
     * Test the Validator without settings rules
     * @throws Exception
     */
    public function testValidWithNoRules()
    {
        $validator = Validator::make([
            'Name' => 'John'
        ]);

        $this->assertTrue($validator->validate());
    }

    /**
     * Required needs to be valid
     * @throws Exception
     */
    public function testRequiredValid()
    {
        $validator = Validator::make([
            'Name' => 'John'
        ], ['Name' => 'required']);

        $this->assertTrue($validator->validate());
    }

    /**
     * Required needs to be invalid
     * @throws Exception
     */
    public function testRequiredInValid()
    {
        $validator = Validator::make([
            'Email' => 'john@cube.nl'
        ], ['Name' => 'required']);

        $this->assertFalse($validator->validate());
    }

    /**
     * Required rule needs to be valid
     * with a non existing field
     * @throws Exception
     */
    public function testRequiredWithNonExistingField()
    {
        $validator = Validator::make([
            'Name' => 'John'
        ], ['DoesNotExist' => 'required']);

        $this->assertFalse($validator->validate());
    }

    /**
     * Min rule needs to be valid
     * @throws Exception
     */
    public function testMinValid()
    {
        $validator = Validator::make([
            'Age' => 22
        ], ['Age' => 'min:18']);

        $this->assertTrue($validator->validate());
    }

    /**
     * Min rule needs to be invalid
     * @throws Exception
     */
    public function testMinInValid()
    {
        // Length needs to be at least 5
        $validator = Validator::make([
            'Age' => 17
        ], ['Age' => 'min:18']);

        $this->assertFalse($validator->validate());

        // Value needs to be numeric
        $validator = Validator::make([
            'Age' => '18'
        ], ['Age' => 'min:2']);

        $this->assertFalse($validator->validate());

        // Value needs to be a string
        $validator = Validator::make([
            'Age' => ['key' => 'value']
        ], ['Age' => 'min:2']);

        $this->assertFalse($validator->validate());

        // Value needs to be a string
        $validator = Validator::make([
            'Age' => false
        ], ['Age' => 'min:2']);

        $this->assertFalse($validator->validate());
    }

    /**
     * Min rule needs to be valid
     * @throws Exception
     */
    public function testMinLengthValid()
    {
        $validator = Validator::make([
            'Name' => 'John'
        ], ['Name' => 'min_length:2']);

        $this->assertTrue($validator->validate());
    }

    /**
     * Min rule needs to be invalid
     * @throws Exception
     */
    public function testMinLengthInValid()
    {
        // Length needs to be at least 5
        $validator = Validator::make([
            'Name' => 'John'
        ], ['Name' => 'min_length:5']);

        $this->assertFalse($validator->validate());

        // Value needs to be a string
        $validator = Validator::make([
            'Name' => 1
        ], ['Name' => 'min_length:2']);

        $this->assertFalse($validator->validate());

        // Value needs to be a string
        $validator = Validator::make([
            'Name' => ['key' => 'value']
        ], ['Name' => 'min_length:2']);

        $this->assertFalse($validator->validate());

        // Value needs to be a string
        $validator = Validator::make([
            'Name' => false
        ], ['Name' => 'min_length:2']);

        $this->assertFalse($validator->validate());
    }

    /**
     * Max needs to be valid
     * @throws Exception
     */
    public function testMaxValid()
    {
        $validator = Validator::make([
            'Age' => 49
        ], ['Age' => 'max:50']);

        $this->assertTrue($validator->validate());
    }

    /**
     * Max rule needs to be invalid
     * @throws Exception
     */
    public function testMaxInValid()
    {
        // Length needs to be at least 5
        $validator = Validator::make([
            'Age' => 20
        ], ['Age' => 'max:18']);

        $this->assertFalse($validator->validate());

        // Value needs to be numeric
        $validator = Validator::make([
            'Age' => '18'
        ], ['Age' => 'max:2']);

        $this->assertFalse($validator->validate());

        // Value needs to be a string
        $validator = Validator::make([
            'Age' => ['key' => 'value']
        ], ['Age' => 'max:2']);

        $this->assertFalse($validator->validate());

        // Value needs to be a string
        $validator = Validator::make([
            'Age' => false
        ], ['Age' => 'max:2']);

        $this->assertFalse($validator->validate());
    }

    /**
     * Max rule needs to be valid
     * @throws Exception
     */
    public function testMaxLengthValid()
    {
        $validator = Validator::make([
            'Name' => 'abc'
        ], ['Name' => 'max_length:3']);

        $this->assertTrue($validator->validate());
    }

    /**
     * Min rule needs to be invalid
     * @throws Exception
     */
    public function testMaxLengthInValid()
    {
        // Length needs to be at least 5
        $validator = Validator::make([
            'Name' => 'abc'
        ], ['Name' => 'max_length:2']);

        $this->assertFalse($validator->validate());

        // Value needs to be a integer
        $validator = Validator::make([
            'Name' => 18
        ], ['Name' => 'max_length:2']);

        $this->assertFalse($validator->validate());

        // Value needs to be a integer
        $validator = Validator::make([
            'Name' => ['key' => 'value']
        ], ['Name' => 'max_length:2']);

        $this->assertFalse($validator->validate());

        // Value needs to be a integer
        $validator = Validator::make([
            'Name' => false
        ], ['Name' => 'max_length:2']);

        $this->assertFalse($validator->validate());
    }

    /**
     * Regex rule needs to be valid
     * @throws Exception
     */
    public function testRegexValid()
    {
        $validator = Validator::make([
            'Test' => 'This is Cube'
        ], ['Test' => ['regex:/cube/i']]);

        $this->assertTrue($validator->validate());
    }

    /**
     * Regex rule needs to be invalid
     * @throws Exception
     */
    public function testRegexInValid()
    {
        $validator = Validator::make([
            'Test' => 'Regex does not match'
        ], ['Test' => ['regex:/cube/i']]);

        $this->assertFalse($validator->validate());
    }

    /**
     * Email rule needs to be valid
     * @throws Exception
     */
    public function testEmailValid()
    {
        $validator = Validator::make([
            'Email' => 'info@cube.nl'
        ], ['Email' => 'email']);

        $this->assertTrue($validator->validate());
    }

    /**
     * Email rule needs to be invalid
     * @throws Exception
     */
    public function testEmailInValid()
    {
        $validator = Validator::make([
            'Email' => 'info@'
        ], ['Email' => 'email']);

        $this->assertFalse($validator->validate());

        $validator = Validator::make([
            'Email' => 'info'
        ], ['Email' => 'email']);

        $this->assertFalse($validator->validate());

        $validator = Validator::make([
            'Email' => 'info@cube..nl'
        ], ['Email' => 'email']);

        $this->assertFalse($validator->validate());
    }
}
