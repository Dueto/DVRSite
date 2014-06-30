<?php
require("../conf/config.php");


class sqlConnection 
{
    var $connection = NULL;
    
    var $host;
    var $port;

    var $database;
    var $table;

    var $user;
    var $password;

    function __construct()
    {
        global $DB;
        $this->host = $DB["host"];
        $this->port = $DB["port"];

        $this->database = $DB["database"];
        $this->table =  $DB["table"];

        $this->user = $DB["user"];
        $this->password = $DB["password"];       
        try
        {
            $this->connection = new \PDO('mysql:host=' . $this->host . ':' . $this->port . 
                                        ';dbname=' . $this->database . ';charset=utf8mb4', 
                                         $this->user, 
                                         $this->password, 
                                         array(\PDO::ATTR_PERSISTENT => true,
                                         \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
                                        );                
            if($this->connection === null)
            {
                return null;
            }
        }
        catch(\PDOException $ex)
        {                
            throw $ex;
        }
          
    }
    
    function insertClientRecord($name, $phoneNumber, $email = NULL, $referrer)
    {   
        $sqlStatement = $this->formInsertStatement();          
        try
        {  
            if($this->connection !== null)
            {
              $handler = $this->connection->prepare($sqlStatement);  

              $handler->bindValue(':id', $this->guid(), \PDO::PARAM_STR);
              $handler->bindValue(':name', $name, \PDO::PARAM_STR); 
              $handler->bindValue(':phoneNumber', $phoneNumber, \PDO::PARAM_STR); 
              $handler->bindValue(':email', $email, \PDO::PARAM_STR); 
              $handler->bindValue(':referrer', $referrer, \PDO::PARAM_STR); 
             
              $handler->execute();            
              $handler->closeCursor();                
              return true;              
            }
            else
            {
                return null;
            }
        }
        catch(\PDOException $ex)
        {   
            $this->connection = null;            
            throw $ex;  
        }        
    }

    function formInsertStatement()
    {    
          return "INSERT INTO `clients` (`id`, `name`, `phoneNumber`, `email`, `referrer`) VALUES (:id, :name, :phoneNumber, :email, :referrer);";
    }   

    function guid()
    {
        if (function_exists('com_create_guid'))
        {
            return com_create_guid();
        }
        else
        {
            mt_srand((double)microtime()*10000);

            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);
            $uuid = substr($charid, 0, 8).$hyphen
                    .substr($charid, 8, 4).$hyphen
                    .substr($charid,12, 4).$hyphen
                    .substr($charid,16, 4).$hyphen
                    .substr($charid,20,12);
            return $uuid;
        }
    }

    function dispose()
    {
        $this->connection = null;
    }

}

?>