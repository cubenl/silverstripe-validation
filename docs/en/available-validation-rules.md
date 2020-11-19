# Available Validation Rules
Below is a list of all available validation rules and a description of their function:

- [Required](#ruleRequired)
- [Min](#ruleMin)
- [Min Length](#ruleMinLength)
- [Max](#ruleMax)
- [Max Length](#ruleMaxLength)
- [Regex](#ruleRegex)
- [Email](#ruleEmail)

### <a name="ruleRequired"></a>Required
The data must be present and not empty.
The data is considered empty when:

- The value is `null`
- The value is an empty string

### <a name="ruleMin"></a>Min
The data must be of the type `integer`, and be greater or equal to the given number.

### <a name="ruleMinLength"></a>Min Length
The data must be of the type `string`, and have a minimum amount of characters.

### <a name="ruleMax"></a>Max
The data must be of the type `integer`, and be less or equal to the given number.

### <a name="ruleMaxLength"></a>Max Length
The data must be of the type `string`, and must have fewer characters than the given number.

### <a name="ruleRegex"></a>Regex
The data must match the given `regular expression`.

<b>Note:</b> When using the regex patterns it may be necessary to define the rules
in an array instead of using pipe delimiters, especially when the regular expression contains a pipe character.

### <a name="ruleEmail"></a>Email
The data must be a valid email address. 
This rule will use standard RFC-like email validation under te hood.
