<?php
declare(strict_types = 1);
Class Validation 
{

    public $regexpatterns = array(
        'timezone'  => '[A-Za-z]',
        'date'      => '[0-9-]{6,8}',
        'username'  => '[a-zA-Z0-9]',
        'password'  => '((?=.*\d)(?=.*[A-Z])(?=.*\W).{8,30})'
    );

    public $filterpattern = array(
        'email'     => FILTER_VALIDATE_EMAIL,
        'ip'        => FILTER_VALIDATE_IP,
        'int'       => FILTER_VALIDATE_INT,
        'float'     => FILTER_VALIDATE_FLOAT,
        'url'       => FILTER_VALIDATE_URL,
        'boolean'   => FILTER_VALIDATE_BOOLEAN
    );

    public $sanitizepattern = array (
        'string'             => FILTER_SANITIZE_STRING,
        'stripped'          => FILTER_SANITIZE_STRIPPED,
        'encoded'           => FILTER_SANITIZE_ENCODED,
        'special_chars'     => FILTER_SANITIZE_SPECIAL_CHARS,
        'email'             => FILTER_SANITIZE_EMAIL,
        'url'               => FILTER_SANITIZE_URL,
        'number_int'        => FILTER_SANITIZE_NUMBER_INT,
        'number_float'      => FILTER_SANITIZE_NUMBER_FLOAT,
    );

    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    public function load()
    {
        if (empty($this->error)) 
        {
            return true;
        }
    }
    public function error($error)
    {
        $this->error = $error;
        return $this;
    }
    
    public function isRequired()
    {
        if (empty($this->value) || $this->value == null )
        {
            $this->error = "He";
        }

        return $this;
    }

    public function regex($pattern)
    {
        $this->pattern = $pattern;
        //Det här överför information till en annan variabel. För att enklare läsa koden.
        $conversion = $this->regexpatterns[$pattern];
        //Samma sak här, gör det lättare att läsa koden
        $regex = array("options"=>array("regexp"=>"/$conversion/"));
        if(!filter_var($this->value, FILTER_VALIDATE_REGEXP,$regex))
        {
            $this->error = "He";
        }

        return $this;
    }

    public function filter($pattern)
    {
        $this->filter = $pattern;
        $conversion = $this->filterpattern[$pattern];
        if (!filter_var($this->value, $conversion))
        {
            //Fyller strängen error, så det inte är tom.
            $this->error = "He";
        }
    }
}
