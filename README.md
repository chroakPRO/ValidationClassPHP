# PHP Validation Class!

This is a validation class for php. You have regex validation, the standard filter_validate, and filter_sanitize.

## Getting Started

`include_once 'Validation.class.php'`
`$validation = new Validation();`

### Main Methods 

``` 
value() // This is the value you wanna validate.
sanitize() // This is what type of sanitization you wanna use! (All types are listed below)
regex() // This is what type of regex you wanna use! (All types are listed below)
filter() // This is what type of filter validation u wanna use (All types are listed below)
isRequired() // This is used if a value can not be empty and is required.
load() // This check if validation was successful or not.
```

### sanitize() Types
```
        'string'             => FILTER_SANITIZE_STRING,
        'stripped'          => FILTER_SANITIZE_STRIPPED,
        'encoded'           => FILTER_SANITIZE_ENCODED,
        'special_chars'     => FILTER_SANITIZE_SPECIAL_CHARS,
        'email'             => FILTER_SANITIZE_EMAIL,
        'url'               => FILTER_SANITIZE_URL,
        'number_int'        => FILTER_SANITIZE_NUMBER_INT,
        'number_float'      => FILTER_SANITIZE_NUMBER_FLOAT,
```

### regex() Types
```
        'timezone'  => '[A-Za-z]',
        'date'      => '[0-9-]{6,8}',
        'username'  => '[a-zA-Z0-9]',
        'password'  => '((?=.*\d)(?=.*[A-Z])(?=.*\W).{8,30})'
      
        //More can be added!
    
```


### filter() Types
```
        'email'     => FILTER_VALIDATE_EMAIL,
        'ip'        => FILTER_VALIDATE_IP,
        'int'       => FILTER_VALIDATE_INT,
        'float'     => FILTER_VALIDATE_FLOAT,
        'url'       => FILTER_VALIDATE_URL,
        'boolean'   => FILTER_VALIDATE_BOOLEAN
```

## Examples

```
   $validation->value($date1)->sanitize('string')->regex('date')->isRequired();
   $validation->value($date2)->sanitize('string')->regex('date')->isRequired();
   $validation->value($timezone1)->sanitize('string')->regex('timezone')->isRequired();
   $validation->value($timezone2)->sanitize('string')->regex('timezone')->isRequired();
   $validation->value($username)->sanitize('string')->regex('timezone')->isRequired();
   $validation->value($email)->sanitize('email')->filter('email')->isRequired();
   
      if ($validation->load())
   {
      $validation->cleanDisplay();
   }

```

