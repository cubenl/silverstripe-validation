<?php

namespace Cube\SilverStripe\Validation;

use Exception;

/**
 * Class Validator
 * @package Cube\SilverStripe\Validation
 */
class Validator
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var array
     */
    private $rules;

    /**
     * @var
     */
    private $customMessages = [];

    /**
     * @var array
     */
    private $errors = [];

    /**
     * Validator constructor.
     *
     * @param array $data
     * @param array $rules
     */
    public function __construct(array $data = [], array $rules = [])
    {
        $this->data = $data;
        $this->rules = ValidationRuleParser::make($rules)->getData();
    }

    /**
     * Validate
     * @throws Exception
     */
    public function validate()
    {
        foreach ($this->rules as $field => $rules) {
            foreach ($rules as $rule => $arguments) {
                $this->validateField($rule, $field, $arguments);
            }
        }

        return count($this->errors()) === 0;
    }

    /**
     * @param array $messages
     */
    public function setCustomMessages(array $messages)
    {
        $this->customMessages = $messages;
    }

    /**
     * @param string $rule
     * @param string $field
     * @param array $arguments
     * @throws Exception
     */
    private function validateField(string $rule, string $field, array $arguments = [])
    {
        $validationRule = ValidationRules::get($rule);
        $value = $this->getValue($field);

        if (!$validationRule->passes($value, $arguments)) {
            // The value did not meet the rules requirements
            $this->addError($rule, $field, $arguments);
        }
    }

    /**
     * @param string $rule
     * @param string $field
     * @param array $arguments
     */
    private function addError(string $rule, string $field, array $arguments = [])
    {
        $arguments = count($arguments) > 0 ? [$rule => $arguments[0]] : [];

        $message = MessageProvider::make($rule, $field, $arguments, $this->customMessages);

        $this->errors[$field][] = $message->get();
    }

    /**
     * @param string $field
     * @return array
     */
    public function errors(string $field = '')
    {
        if ($field && isset($this->errors[$field])) {
            return $this->errors[$field];
        }

        return $this->errors;
    }

    /**
     * @param string $field
     * @return mixed|null
     */
    private function getValue(string $field)
    {
        return isset($this->data[$field]) ? $this->data[$field] : null;
    }

    /**
     * @param array $data
     * @param array $rules
     * @return static
     */
    public static function make(array $data = [], array $rules = [])
    {
        return new static($data, $rules);
    }
}
