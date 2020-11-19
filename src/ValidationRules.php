<?php

namespace Cube\SilverStripe\Validation;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Exception;
use SilverStripe\Core\ClassInfo;
use Cube\SilverStripe\Validation\Interfaces\Rule;

/**
 * Class ValidationRules
 * @package Cube\SilverStripe\Validation
 */
class ValidationRules
{
    /**
     * @var
     */
    private $validationMethod;

    /**
     * @param string $rule
     * @return static
     * @throws Exception
     */
    public static function get(string $rule)
    {
        $rules = new static();

        $rules->setValidationMethod($rule);

        return $rules;
    }

    /**
     * @param string $rule
     * @throws Exception
     */
    private function setValidationMethod(string $rule)
    {
        $method = 'validate' . ucfirst($rule);
        $break = strpos($rule, '_');

        if ($break) {
            $method = 'validate'.ucfirst(substr($rule, 0, $break)) . ucfirst(substr($rule, $break + 1));
        }

        if (method_exists($this, $method)) {
            $this->validationMethod = $method;
        } elseif ($customRule = $this->getCustomValidationRule($rule)) {
            $this->validationMethod = $customRule;
        } else {
            // This rule does not exist
            throw new Exception("The validation rule '{$rule}' does not exist.");
        }
    }

    /**
     * @param string $rule
     * @return bool|mixed
     * @throws Exception
     */
    private function getCustomValidationRule(string $rule)
    {
        foreach (ClassInfo::implementorsOf(Rule::class) as $class) {
            $properties = get_class_vars($class);

            if (isset($properties['name']) && $rule === $properties['name']) {
                return new $class();
            }
        }

        return false;
    }

    /**
     * @param $value
     * @param array $arguments
     * @return false
     */
    public function passes($value, array $arguments = [])
    {
        if (is_object($this->validationMethod)) {
            return $this->validationMethod->passes($value);
        }

        if (count($arguments) > 0) {
            return $this->{$this->validationMethod}($value, $arguments);
        }
        return $this->{$this->validationMethod}($value);
    }

    /**
     * @param $str
     * @return false|int
     */
    private function strLength($str = '')
    {
        if (!is_string($str)) {
            return false;
        }

        return strlen($str);
    }

    /**
     * @param $value
     * @return bool
     */
    protected function validateRequired($value)
    {
        return $value !== null
            && !empty($value)
            || (is_array($value) && count($value) > 0);
    }

    /**
     * @param $value
     * @param $arguments
     * @return bool
     */
    protected function validateMin($value, $arguments)
    {
        if (!is_numeric($value) || is_string($value)) {
            return false;
        } else {
            return $arguments[0] <= $value;
        }
    }

    /**
     * @param $value
     * @param $arguments
     * @return bool
     */
    protected function validateMinLength($value, $arguments)
    {
        $length = $this->strLength($value);

        return ($length !== false) && $length >= (int) $arguments[0];
    }

    /**
     * @param $value
     * @param $arguments
     * @return bool
     */
    protected function validateMax($value, $arguments)
    {
        if (!is_numeric($value) || is_string($value)) {
            return false;
        } else {
            return $arguments[0] >= $value;
        }
    }

    /**
     * @param $value
     * @param $arguments
     * @return bool
     */
    protected function validateMaxLength($value, $arguments)
    {
        $length = $this->strLength($value);

        return ($length !== false) && $length <= (int) $arguments[0];
    }

    /**
     * @param $value
     * @param $arguments
     * @return false|int
     */
    protected function validateRegex($value, $arguments)
    {
        return preg_match($arguments[0], $value);
    }

    /**
     * @param $value
     * @return bool
     */
    protected function validateEmail($value)
    {
        $validator = new EmailValidator();

        return $validator->isValid($value, new RFCValidation());
    }
}
