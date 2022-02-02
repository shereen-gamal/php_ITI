<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
<?php
$nameErr=$passErr="";
?>

<form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="mt-3">
    <div class="container bg-dark text-white mt-3">
        <div class="row p-3 h3 text-warning"> login form  </div>
        <div class="row">

            <div class="m-2  col">
                <label for="username" class="form-label">@username</label>
                <input type="text" class="form-control" name="username" id="username">
                <div  class="form-text">Enter username</div>
                <small class="text-danger"><?= $nameErr;?></small>
            </div>

        </div>
        <div class="row">

            <div class="m-2  col">
                <label for="password" class="form-label">Full Name</label>
                <input type="password" class="form-control" name="password" id="password">
                <div  class="form-text">Enter password</div>
                <small class="text-danger"><?= $passErr;?></small>
            </div>

        </div>
        <div class="row">

            <div class="m-2  col">
                <button type="submit" class="form-control btn btn-warning" name="login" id="login">login</button>
                <small class="text-warning">only admin can access database</small>
            </div>

        </div>
    </div>
</form>

</body>
</html>

<?php
if(isset($_POST['username'])&& !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
    $username =$_POST['username'];
    $password = $_POST['password'];
    require "connection.php";
    $query = $connection->prepare("SELECT * FROM admin");
    $query->execute();
    $admin = $query->fetchAll(PDO::FETCH_ASSOC);
//    var_dump($admin);
    if($username==$admin[0]['username'] && $password==$admin[0]['password']){
        header("Location:index.php");
    }
    else{
        echo "<div class='container bg-dark'><h3 class='text-warning row p-3'>only admin can access database</h3></div>";
    }
}
