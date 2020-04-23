<?php
Class Validation 
{    
    //Array med olika regex som vi kan välja mellan, det är det som kallas efter pattern('date') pattern('password')
    public $regexpatterns = array(
        'timezone'  => '[A-Za-z]',
        'date'      => '[0-9-]{6,8}',
        'username'  => '[a-zA-Z0-9]',
        'password'  => '((?=.*\d)(?=.*[A-Z])(?=.*\W).{8,30})'
    );
//Array med alla för programmerade filter.
    public $filterpattern = array(
        'email'     => FILTER_VALIDATE_EMAIL,
        'ip'        => FILTER_VALIDATE_IP,
        'int'       => FILTER_VALIDATE_INT,
        'float'     => FILTER_VALIDATE_FLOAT,
        'url'       => FILTER_VALIDATE_URL,
        'boolean'   => FILTER_VALIDATE_BOOLEAN
    );
//Array med alla för programmerade sanerare.
    public $sanitizepattern = array (
        'string'            => FILTER_SANITIZE_STRING,
        'stripped'          => FILTER_SANITIZE_STRIPPED,
        'encoded'           => FILTER_SANITIZE_ENCODED,
        'special_chars'     => FILTER_SANITIZE_SPECIAL_CHARS,
        'email'             => FILTER_SANITIZE_EMAIL,
        'url'               => FILTER_SANITIZE_URL,
        'number_int'        => FILTER_SANITIZE_NUMBER_INT,
        'number_float'      => FILTER_SANITIZE_NUMBER_FLOAT,
    );
    public $cleanStrings = array ();
    //Här är metoden som sätter vilket värde vi vill validera.
   public function value($value)
    {
        $this->value = $value;
        //För varje värde som kommer in som value, lägg in det i arrayn CleanStrings
        array_push($this->cleanStrings, $this->value);
        return $this;
    } 
    //Metoden som tittar om validering fungerade.
    public function load()
    {
       //Om metoden Error är tom så retuneras true, vilket gör att validering av värdet var lyckat.
        if (empty($this->error)) 
        {
            return true;
        }
    }
    //Error metod, som används för att testa om validering inte gick ingom, vilket sker om $error har ett värde.
    public function error($error)
    {
        $this->error = $error;
        return $this;
    }
    //Metod som används för att testa om värdet är tomt eller null
    public function isRequired()
    {
        //Om värdet är tomt eller null, så skickas en sträng till Error
        if (empty($this->value) || $this->value == null )
        {
            $this->error = "He";
        }
        return $this;
    }
    //Main metoden för regex validering.
    public function regex($pattern)
    {
        $this->pattern = $pattern;
        //Det här överför information till en annan variabel. För att enklare läsa koden.
        //Här väljer vilken regex vi vill använda.
        $conversion = $this->regexpatterns[$pattern];
        //Samma sak här, gör det lättare att läsa koden, eftersom filter_var med regex är väldigt lång.
        $regex = array("options"=>array("regexp"=>"/$conversion/"));
        //Här kör vi värdet mot den regex som vi har valt. 
        if(!filter_var($this->value, FILTER_VALIDATE_REGEXP,$regex))
        {
          //Om det inte passade så skickar vi in ett värde till Error metoden.
           $this->error = "He";
        }
        //Sen retunerar vi allt, så alla metoder inom klassen kan läsa värdet.
        return $this;
    }
    //Main metoden för alla för programmerade filter validate alterntiv.
    public function filter($pattern)
    {
        $this->filter = $pattern;
         //Det här överför information till en annan variabel. För att enklare läsa koden.
        //Här väljer vilket filter vi vill använda.
        $conversion = $this->filterpattern[$pattern];
        //Här kör vi värdet mot filteret.
        if (!filter_var($this->value, $conversion))
        {
            //Fyller strängen error, så det inte är tom, om filter_var inte lyckades.
            $this->error = "He";
        }
        return $this;
    }
        //Main metoden för alla för programmerade filter sanitize alternativ
        public function sanitize($pattern)
        {
            $this->filter = $pattern;
            //Det här överför information till en annan variabel. För att enklare läsa koden.
            //Här väljer vilken typ av sanering vi vill använda.
            $conversion = $this->sanitizepattern[$pattern];
            //Här sanerare vi värdet.
            $this->value = filter_var($this->value, $conversion);
            return $this;
        }
        //För att visa att stringarna är tvättade
        public function cleanDisplay()
        {
            //för varje element i cleanString, skriv ut det, med ett mellanrum.
            foreach($this->cleanStrings as $display)
            {
                //För varje
                Echo "<br>$display";
            }
        }
}
