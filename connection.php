<?php
try{
    $connection = new PDO('mysql:dbname=itidb;host=localhost','root','');
    var_dump($connection);
}
catch (PDOException $exception){
    echo $exception->getMessage();
}