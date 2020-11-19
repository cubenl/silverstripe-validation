<?php

namespace Cube\SilverStripe\Validation\Tests;

use SilverStripe\Dev\SapphireTest;
use SilverStripe\ORM\ValidationException;
use Cube\SilverStripe\Validation\Tests\Stub\Customer;

/**
 * Class ValidateDataObjectTest
 * @package Cube\SilverStripe\Validation\Tests
 */
class ValidateDataObjectTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'validation.yml';

    /**
     * @var string[]
     */
    protected static $extra_dataobjects = [
        Customer::class
    ];

    /**
     * @throws ValidationException
     */
    public function testValidateDataObject()
    {
        $foo = $this->objFromFixture(Customer::class, 'foo');

        $foo->write();

        $this->assertTrue($foo->exists());

        $bar = $this->objFromFixture(Customer::class, 'bar');

        $this->expectException(ValidationException::class);

        $bar->write();
    }
}
