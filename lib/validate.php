<?php
class Validate
{
    const UNKNOWN = -1;
    private $result = self::UNKNOWN;
    private function setResult($value)
    {
        $this->result = $value;
    }
    private function considerResult($aResult)
    {
        // $message = 
        //     "result = " . 
        //     ($this->result == self::UNKNOWN ? 'UNKNOWN' : $this->result) . 
        //     ", aResult = <" . $aResult . "> ";

        if($this->getResult() == self::UNKNOWN) {
            // $message .= "[a]";
            $this->setResult($aResult);
        } else if($aResult == 0) {
            // $message .= "[b]";
            $this->setResult($aResult);
        } else {
            // $message .= "[c]";
        }

        // $message .= ", new result = " . ($this->result == self::UNKNOWN ? 'UNKNOWN' : $this->result);

        // echo "[" . $message . "]";
    }
    public function isNull($value)
    {
        return !isset($value);
    }

    public function isNotNull($value)
    {
        return isset($value);
    }
    
    public function isNotNullAndNotEmpty($value)
    {
        $isValid = 0;

        if(isset($value))
            if(is_string($value))
                if(strlen($value) > 0)
                    $isValid = 1;
        
        // echo "<<" . $isValid . ">> ";

        return $isValid;
    }

    // ============================
    // PUBLIC API
    // ============================
    
    // restart validation
    public function reset()
    {
        setResult(self::UNKNOWN);
    }
    
    // get accumulated validation result
    public function getResult()
    {
        return $this->result;
    }
    // HENRIQUE
    public function alfanumeric($value)
    {
        $isValid = $this->isNotNullAndNotEmpty($value);
        $this->considerResult($isValid);
        return $isValid;
    }
    // ISHAN
    public function numeric($value)
    {
        $isValid = 0;
        
        if ($this->isNotNull($value)) {
            if(filter_var($value,FILTER_VALIDATE_INT)){
                $isValid = 1;
            }
        }
        
        $this->considerResult($isValid);
        return $isValid;
    }
    // EKTA
    public function email($value)
    {
        $isValid = 0;
        if ($this->isNotNull($value)) {
            if(filter_var($value,FILTER_VALIDATE_EMAIL)){
                $isValid = 1;
            }
        }
        $this->considerResult($isValid);
        return $isValid;
    }
    // GUSTAVO
    public function postalCode($value)
    {
        $isValid = 0;
        if($this->isNotNull($value)){
            $postalCodePattern = '/^[a-zA-Z][0-9][a-zA-Z][ -]?[0-9][a-zA-Z][0-9]$/';
            $isValid = preg_match($postalCodePattern, $value);
        }
        $this->considerResult($isValid);
        return $isValid;
    }
    // BRUNO
    public function phone($value)
    {
        $isValid = 0;
        if($this->isNotNull($value)){
            $phonepattern1 = '/^[0-9]{10,12}$/';
            $phonepattern2 = '/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/';
            $phonepattern3 = '/^\+[0-9]{1,2}\([0-9]{3}\)[0-9]{3}-[0-9]{4}$/';
            $isValid = preg_match($phonepattern1, $value) || preg_match($phonepattern2, $value) || preg_match($phonepattern3, $value);
        }
        $this->considerResult($isValid);
        return $isValid;
    }
    // BRUNO
    public function length($value, $length)
    {
        $isValid = 0;
        if($this->isNotNull($value)){
            $valueLength = strlen((string)$value);
            if($length == $valueLength) $isValid = 1;
        }else{
            if($length == 0) $isValid = 1;
        }
        $this->considerResult($isValid);
        return $isValid;
    }
    // ELIZAVETA
    public function name($value)
    {
        $isValid = 0;
        if($this->isNotNull($value)){
            if(ctype_alpha(str_replace(' ', '', $value)) === true){//Name can contain letters and spaces
                $isValid = 1;
            }
        }
        $this->considerResult($isValid);
        return $isValid;
    }
}