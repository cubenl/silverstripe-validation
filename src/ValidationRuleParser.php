<?php

namespace Cube\SilverStripe\Validation;

/**
 * Class ValidationRuleParser
 * @package Cube\SilverStripe\Validation
 */
class ValidationRuleParser
{
    /**
     * The rules that need to be parsed
     *
     * @var array
     */
    private $rules;

    /**
     * The parsed rules
     * @var
     */
    private $data = [];

    /**
     * The current rule parsing
     *
     * @var
     */
    private $currentRule;

    /**
     * On instantiation add the desired rules
     * into a global accessible variable.
     *
     * @param  array  $rules
     * @return void
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * Parse an array of rules to the format
     * used in @see \Valitron\Validator validation.
     */
    private function parse()
    {
        foreach ($this->rules as $field => $rule) {
            $this->currentRule = $rule;
            $this->data[$field] = $this->explodeRules();
        }
    }

    /**
     * Explode the current rule
     */
    private function explodeRules()
    {
        $exploded = [];
        $rules = $this->currentRule;

        if (!is_array($this->currentRule)) {
            $rules = explode('|', $this->currentRule);
        }

        foreach ($rules as $rule) {

            $arguments = [];

            if (strpos($rule, ':') !== false) {
                $argumentStr = substr($rule, strpos($rule, ':') + 1);
                $arguments = explode(',', $argumentStr);
                $rule = substr($rule, 0, strpos($rule, ':'));
            }

            $exploded[$rule] = $arguments;
        }

        return $exploded;
    }

    /**
     * Retrieve the parsed data
     *
     * @return array
     */
    public function getData() : array
    {
        return $this->data;
    }

    /**
     * Static Factory for the this class.
     * This will create a new instance of this class and
     * parse the given rules to the correct format.
     *
     * @param array $rules The rules that needs to be parsed
     * @return ValidationRuleParser
     */
    public static function make(array $rules) : ValidationRuleParser
    {
        $parser = new static($rules);

        $parser->parse();

        return $parser;
    }

}
