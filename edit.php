<?php

function modify_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
//var_dump($_GET);
if (isset($_GET['id']) && isset($_GET['fullName']) && isset($_GET['username'])&& isset($_GET['password'])&& isset($_GET['cpassword']) && isset($_GET["email"]) && isset($_GET['birth_date']) && isset($_GET['city'])) {

    if (!empty($_GET['id']) && !empty($_GET['fullName']) && !empty($_GET['username']) && !empty($_GET['password']) && !empty($_GET['cpassword']) && !empty($_GET["email"]) && !empty($_GET['birth_date']) && !empty($_GET['city'])) {

        $id = $_GET['id'];
        $full_name = modify_input($_GET['fullName']);
        $username = modify_input($_GET['username']);
        $password = modify_input($_GET['password']);
        $rePassword = modify_input($_GET['cpassword']);
        $encrypted = password_hash($password, PASSWORD_DEFAULT);
        $email = modify_input($_GET["email"]);
        $birth_date = modify_input($_GET["birth_date"]);
        $city = modify_input($_GET["city"]);
        $cond1 = preg_match("/[A-Z -]+/", $full_name);
        $cond2 = preg_match("/[A-Z -]+/", $username);
        $cond3 = filter_var($email, FILTER_VALIDATE_EMAIL);
        $cond4 = preg_match("/.{8,}/", $password);
        $cond5 = ($password != $rePassword);
        require "connection.php";
        $query = $connection->prepare("UPDATE users SET full_name=?,username=?,password=?,email=?,birth_date=?,city=? WHERE id=? ");
        $query->execute([$full_name, $username, $encrypted, $email, $birth_date, $city, $id]);
        header("Location: index.php");
    }
}
?>