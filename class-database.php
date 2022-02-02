<?php
class Database{
    private $database = 'itidb' ;
    private $root = 'root';
    private $password = '';
    private function connect (){
        try{
            $connection = new PDO("mysql:dbname=$this->database;host=localhost",
                $this->root,$this->password);
            return $connection;
        }
        catch (PDOException $exception){
            echo $exception->getMessage();
        }
        return false;
    }
    public function insert($table,$username,$pass){
        $myConnection=$this->connect();
        $query=$myConnection->prepare("insert into $table (username,password) values(?,?);");
        $query->execute([$username,$pass]);
        return $this->select($table);
    }
    public function select($table){
        $myConn =$this->connect();
        $query =$myConn->prepare("select * from $table");
        $query->execute();
        $output =$query->fetchAll(PDO::FETCH_ASSOC);
        return $output;
    }
    public function selectByID($table,$id){
        $myConn =$this->connect();
        $query =$myConn->prepare("select * from $table where id=$id");
        $query->execute();
        $output =$query->fetchAll(PDO::FETCH_ASSOC);
        return $output;
    }

    public function update($table,$id,$username,$pass){
        $myConn = $this->connect();
        $query = $myConn->prepare("update $table set username=? , password=? where id=?");
        $query->execute([$username,$pass,$id]);
        return $this->select($table);
    }
    public function delete ($table,$id){
        $myConn = $this->connect();
        $query = $myConn->prepare("delete from $table where id=?");
        $query->execute([$id]);
        return $this->select($table);
    }

}

$object = new Database();

$tableName ='object';
$columnsName =['username','password'];

$select = $object->select($tableName);
$selectByID = $object->selectByID($tableName,5);

$insert=$object->insert($tableName,"salma","202355");
$delete = $object->delete($tableName,2);
$update = $object->update($tableName,3,'newUpdate','88888');

$object->delete($tableName,1);

$object->update($tableName,1,"ahmed","202122");

$outAfterInsert = $object->select($tableName);

echo "<pre>";
var_dump($select);
echo "<br>";
var_dump($selectByID);
echo "<br>";
var_dump($insert);
echo "<br>";
var_dump($delete);
echo "<br>";
var_dump($update);
echo "</pre>";

