<?php

namespace Cube\SilverStripe\Validation\Extensions;

use Exception;
use SilverStripe\Core\ClassInfo;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\ValidationResult;
use Cube\SilverStripe\Validation\Interfaces\ValidationRules;
use Cube\SilverStripe\Validation\Validator;

/**
 * Class ValidationExtension
 * @package Cube\SilverStripe\Validation\Extensions
 */
class ValidationExtension extends DataExtension
{
    /**
     * @param ValidationResult $result
     * @return ValidationResult|void
     * @throws Exception
     */
    public function validate(ValidationResult $result)
    {
        if (!ClassInfo::classImplements($this->owner->ClassName, ValidationRules::class)) {
            // DataObject does not implement the Validation Interface
            return $result;
        }

        $data = $this->owner->toMap();
        $rules = $this->owner->rules();

        $validator = Validator::make($data, $rules);

        if (method_exists($this->owner, 'messages')) {
            $validator->setCustomMessages($this->owner->messages());
        }

        if (!$validator->validate()) {

            foreach ($validator->errors() as $field => $messages) {
                foreach ($messages as $message) {
                    $result->addFieldError($field, $message);
                }
            }

        }

        return $result;
    }
}
