# Custom Error Messages
In some cases you would like to override the default error messages behaviour.

## Field names
You can change the default field name in an i18n yaml file.

`en.yml`
```yaml
en:
  SilverStripe\Validation\MessageProvider:
    Phone: 'Phone number'
```

## Rule message for a specific field
Define the `messages` method in your DataObject and set the
messages for each rule inside a specific field.

```php
/**
 * Custom validation messages for specific fields
 * This will override the whole message
 * instead of only the Field name
 *
 * @return array
 */
public function messages() : array
{
    return [
        'Age' => [
            // Translations are also possible
            'required' => _t('Age.Required', 'Age is required'),
            // Overrides the default message: "The Age must be at least 18."
            'min' => 'You need to be at least 18 years old.',
        ]
    ];
}

```
