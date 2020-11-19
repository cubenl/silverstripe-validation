<?php

namespace Cube\SilverStripe\Validation;

/**
 * Class MessageProvider
 * @package SilverStripe\Validation
 */
class MessageProvider
{
    /**
     * @var
     */
    private $rule;

    /**
     * @var
     */
    private $field;

    /**
     * @var
     */
    private $arguments;

    /**
     * @var
     */
    private $messages;


    /**
     * MessageProvider constructor.
     * @param string $rule
     * @param string $field
     * @param array $arguments
     * @param array|null $messages
     */
    public function __construct(string $rule, string $field = '', array $arguments = [], array $messages = null)
    {
        $this->rule = $rule;
        $this->field = $field;
        $this->arguments = $arguments;
        $this->messages = $messages;
    }

    /**
     * @return string
     */
    public function get()
    {
        $field = _t(__CLASS__.".{$this->field}", $this->field);

        if ($message = $this->customMessage()) {
            return $message;
        }

        return _t(
            __CLASS__.".{$this->rule}",
            $this->rule,
            array_merge(['field' => $field], $this->arguments)
        );
    }

    /**
     * @return false|string
     */
    private function customMessage()
    {
        if (isset($this->messages[$this->field]) && isset($this->messages[$this->field][$this->rule])) {
            return (string) $this->messages[$this->field][$this->rule];
        }

        return false;
    }

    /**
     * @param string $rule
     * @param string $field
     * @param array $arguments
     * @param array $messages
     * @return MessageProvider
     */
    public static function make(string $rule, string $field = '', array $arguments = [], array $messages = [])
    {
        return new static($rule, $field, $arguments, $messages);
    }
}
