<?php

namespace Cube\SilverStripe\Validation\Extensions;

use SilverStripe\ORM\DataObject;
use Exception;
use SilverStripe\Core\ClassInfo;
use Cube\SilverStripe\Validation\Interfaces\ValidationRules;
use Cube\SilverStripe\Validation\Validator;
use SilverStripe\Core\Validation\ValidationResult;
use SilverStripe\Core\Extension;

/**
 * Class ValidationExtension
 * @package Cube\SilverStripe\Validation\Extensions
 * @extends Extension<(DataObject & static)>
 */
class ValidationExtension extends Extension
{
    /**
     * @param ValidationResult $result
     * @return ValidationResult|void
     * @throws Exception
     */
    public function updateValidate(ValidationResult $result)
    {
        if (!ClassInfo::classImplements($this->getOwner()->ClassName, ValidationRules::class)) {
            // DataObject does not implement the Validation Interface
            return $result;
        }

        $data = $this->getOwner()->toMap();
        $rules = $this->getOwner()->rules();

        $validator = Validator::make($data, $rules);

        if (method_exists($this->getOwner(), 'messages')) {
            $validator->setCustomMessages($this->getOwner()->messages());
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
