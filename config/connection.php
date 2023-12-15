<?php

class DatabaseConnection
{


    public static function connect()
    {
       return new mysqli("localhost","root","","crudoop");
    }
}

$con = DatabaseConnection::connect();

?>