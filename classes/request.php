<?php
require('mailsender.php');
require('sqlconnection.php');

class Request 
{  
    var $email = null;
    var $phoneNumber = null;
    var $name = null;
    var $referrer = null;

    function __construct($request)
    {
        if(isset($request["email"]))
        {
           $this->email = $request["email"];
        }
        $this->phoneNumber = $request["telephone"];
        $this->name = $request["name"];  
        $this->referrer = $request["referrer"];           
    }

    function processRequest()
    {   
        try
        {
          $sender = new mailSender(); 
          $connection = new sqlConnection();
          $sender->sendMail($this->name, $this->phoneNumber, $this->referrer);
          $connection->insertClientRecord($this->name, $this->phoneNumber, null ,$this->referrer);
          $connection->dispose();
        }
        catch(\PDOException $ex)
        {
           echo $ex;
        }        
    }
    
   

}

?>