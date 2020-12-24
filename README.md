# PHP Validation Class!

This is a validation class for php. You have regex validation, the standard filter_validate, and filter_sanitize.

More will be added in the future.

## Getting Started
```php
include_once 'Validation.class.php'
$validation = new Validation();
```

### Main Methods 

```php
value() // This is the value you wanna validate.
sanitize() // This is what type of sanitization you wanna use! (All types are listed below)
regex() // This is what type of regex you wanna use! (All types are listed below)
filter() // This is what type of filter validation u wanna use (All types are listed below)
isRequired() // This is used if a value can not be empty and is required.
load() // This check if validation was successful or not.
cleanDisplay() // Only did this to display the sanitized strings!
```

### sanitize() Types
```php
        'string'            => FILTER_SANITIZE_STRING,
        'stripped'          => FILTER_SANITIZE_STRIPPED,
        'encoded'           => FILTER_SANITIZE_ENCODED,
        'special_chars'     => FILTER_SANITIZE_SPECIAL_CHARS,
        'email'             => FILTER_SANITIZE_EMAIL,
        'url'               => FILTER_SANITIZE_URL,
        'number_int'        => FILTER_SANITIZE_NUMBER_INT,
        'number_float'      => FILTER_SANITIZE_NUMBER_FLOAT,
```

### regex() Types
```php
        'timezone'  => '[A-Za-z]',
        'date'      => '[0-9-]{6,8}',
        'username'  => '[a-zA-Z0-9]',
        'password'  => '((?=.*\d)(?=.*[A-Z])(?=.*\W).{8,30})'
      
        //More can be added!
    
```


### filter() Types
```php
        'email'     => FILTER_VALIDATE_EMAIL,
        'ip'        => FILTER_VALIDATE_IP,
        'int'       => FILTER_VALIDATE_INT,
        'float'     => FILTER_VALIDATE_FLOAT,
        'url'       => FILTER_VALIDATE_URL,
        'boolean'   => FILTER_VALIDATE_BOOLEAN
```

## Examples


This sort dosent work atm, since it a return function so if u try to sanitizie the string it wont work. Only validate work. Remove 


```php

$validation2 = new \Validation();
/Cleans strings.
$this->user = filter_input(INPUT_POST, 'feedback-option', FILTER_SANITIZE_STRING);
$this->feedback = filter_input(INPUT_POST, 'feedback-text', FILTER_SANITIZE_STRING);
//Kontrollerar strängerna.
$validation2->value($this->feedback)->regex('feedback-text')->isRequired();
$validation2->value($this->user)->filter('int')->isRequired();
//Om den inte går ingeom kontrollen
if (!$validation2->load())
{
header ("Location: ../../../../Index.php?error=invalidinput");
exit();
}
```

