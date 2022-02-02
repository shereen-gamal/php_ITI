<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>


<div class="container-flui">
<?php
try{
    $connection = new PDO('mysql:dbname=itidb;host=localhost','root','');
    $query = $connection->prepare("Select * FROM users");
    $query->execute();
    $users=$query->fetchAll(PDO::FETCH_ASSOC);
    $numOfUsers = count($users);
    ?>
    <table class="table table-striped m-2 table-hover">
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
            <th>Birthdate</th>
            <th>City</th>
            <th>Update?</th>
            <th>Delete?</th>
        </tr>
        <?php
        for($i=0;$i<$numOfUsers;$i++){
            echo "<tr>
                <td>".$users[$i]["id"]."</td>
                <td>".$users[$i]["full_name"]."</td>
                <td>".$users[$i]["username"]."</td>
                <td>".$users[$i]["password"]."</td>
                <td>".$users[$i]["email"]."</td>
                <td>".$users[$i]["birth_date"]."</td>
                <td>".$users[$i]["city"]."</td>
                <td><a class='btn btn-success' href='update.php?id=".$users[$i]['id']."'>Update</a></td>
                <td><a class='btn btn-danger' href='delete.php?id=".$users[$i]['id']."'>Delete</a></td>
             </tr>";
        }?>
    </table>
    <div class="container-fluid">
        <div class="row">
            <div class="col"></div>
            <div class="col-2">
                <a class='btn btn-primary' href="form.php">Add User</a>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <?php
}
catch (PDOException $exception){
    echo $exception->getMessage();
}?>

</div>
</body>
</html>


