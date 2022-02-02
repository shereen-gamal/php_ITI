<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

<?php
$emailErr = $nameErr = $usernameErr =$passwordErr=$passwordErr2=$dateErr="";
$full_name=$username=$email=$password=$city=$birth_date="";

function modify_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_GET['fullName']) && isset($_GET['username'])&& isset($_GET['password'])&& isset($_GET['cpassword']) && isset($_GET["email"]) && isset($_GET['birth_date']) && isset($_GET['city'])){
    $full_name= modify_input($_GET['fullName']) ;
    $username= modify_input($_GET['username']) ;
    $password= modify_input($_GET['password']) ;
    $rePassword = modify_input($_GET['cpassword']);
    $encrypted = password_hash($password ,  PASSWORD_DEFAULT);
    $email = modify_input($_GET["email"]) ;
    $birth_date = modify_input($_GET["birth_date"]);
    $city = modify_input($_GET["city"]);

    $cond1=preg_match("/[A-Z -]+/",$full_name);
    $cond2=preg_match("/[A-Z -]+/",$username);
    $cond3=filter_var($email,FILTER_VALIDATE_EMAIL);
    $cond4=preg_match("/.{8,}/",$password);
    $cond5=($password!=$rePassword);

    if ($_SERVER["REQUEST_METHOD"] == "GET"){

        if(empty($full_name)){
            $nameErr="required";
        }
        elseif ($cond1){
            $nameErr="invalid input no spaces no dashes no uppercase";
        }
        if(empty($username)){
            $usernameErr="required username";
        }
        elseif ($cond2){
            $usernameErr="invalid input no spaces no dashes no uppercase";
        }
        if(empty($email)){
            $emailErr="email is required";
        }
        elseif (!$cond3){
            $emailErr="invalid email";
        }
        if(empty($password)){
            $passwordErr = "password required";
        }
        elseif (!$cond4){
            $passwordErr = "invalid password length 8 or more";
        }
        if($rePassword != $password){
            $passwordErr2= "password does not match";
        }


    }
    if($full_name!="" && $username!="" && $encrypted!="" && $email!="" &&  $birth_date!="" && $city!="" && !$cond1 && !$cond2 && $cond3 && $cond4 && !$cond5){
        require "connection.php";
        $query = $connection ->prepare("INSERT INTO users (full_name,username,password,email,birth_date, city)VALUES(?,?,?,?,?,?)");
        $query->execute([$full_name,$username,$encrypted,$email,$birth_date,$city]);
        header("Location: index.php");
    }
}
?>

<form method="get" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2"></div>
            <div class="m-2  col-4">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="fullName" id="fullName">
                <div  class="form-text">Enter your full name</div>
                <small class="text-danger"><?= $nameErr;?></small>
            </div>
            <div class="m-2 col-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username">
                <div  class="form-text">Enter your username</div>
                <small class="text-danger"><?= $usernameErr;?></small>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2"></div>
            <div class="m-2 col-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
                <div  class="form-text">Enter your password</div>
                <small class="text-danger"><?= $passwordErr;?></small>
            </div>
            <div class="m-2 col-4">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="cpassword" id="cpassword">
                <div  class="form-text">Renter your password</div>
                <small class="text-danger"><?= $passwordErr2;?></small>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2"></div>
            <div class="m-2 col-8">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email">
                <div  class="form-text">Enter your Email</div>
                <small class="text-danger"><?= $emailErr;?></small>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2"></div>
            <div class="m-2 col-4">
                <label for="birth_date" class="form-label">Birthdate</label>
                <input type="date" class="form-control" name="birth_date" id="birth_date">
                <div  class="form-text">Enter your date of birth</div>
                <small class="text-danger"><?= $dateErr;?></small>
            </div>
            <div class="m-2 col-4">
                <label for="city" class="form-label">City</label>
                <select name="city" id="city" class="form-select">
                    <option value="cairo">cairo</option>
                    <option value="sohag">sohag</option>
                    <option value="alex">alex</option>
                    <option value="aswan">aswan</option>
                </select>
                <div  class="form-text">Choose your city</div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-8"></div>
            <button type="submit" class="btn btn-primary m-2 col-2" >Register</button> <br>
            <div class="col-2"></div>
        </div>
    </div>

</form>
</body>
</html>