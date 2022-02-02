<?php
if(isset($_GET['id'])&& !empty($_GET['id'])){
    $id=$_GET['id'];
    require "connection.php";
    $query = $connection->prepare("DELETE FROM users WHERE id=?");
    $query->execute([$id]);
    header('Location:index.php');
}
