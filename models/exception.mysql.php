<?php
class DatabaseException{
    public function __construct(string $message = "", int $code = 0, PDOException $e = null)
    {
        if (is_subclass_of($message, PDOException))
        {
            $e = $message;
            $code = $e->getCode();
            $message = $e->getMessage();
        }
       
        parent::__construct($message, $code, $e);


        $state = $this->getMessage();
        if(!strstr($state, 'SQLSTATE['))
            $state = $this->getCode();
        if(strstr($state, 'SQLSTATE['))
        {
            preg_match('/SQLSTATE\[(\w+)\] \[(\w+)\] (.*)/', $state, $matches);
            $this->code = ($matches[1] == 'HT000' ? $matches[2] : $matches[1]);
            $this->message = $matches[3];
        }
    }


}
?>