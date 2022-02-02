
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
<form action="" method="post">
    <div class="container-fluid">
        <div class="row bg-dark">
            <div class="col-2"></div>
            <div class="col-6">
                <input type="text" name="search" class="form-control m-3">
            </div>
            <div class="col-2">
                <input type="submit" name="submit" value="Search" class="form-control m-3 btn btn-warning">
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</form>
</body>
</html>

<?php
echo "<pre>";
//var_dump($_POST);
echo "</pre>";
if (isset($_POST['search']) && !empty($_POST['search'])){
    $search =$_POST['search'];

    echo "<h3>Search for ".$search."</h3>";
    require "connection.php";
    $query=$connection->prepare("select * from users where full_name like '%$search%'");
    $query->execute();
    $searchedUsers =$query->fetchAll(PDO::FETCH_ASSOC);
//    echo "<pre>";
//    var_dump($searchedUsers);
//    echo "</pre>";
}
$count = count($searchedUsers);
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
        for($i=0;$i<$count;$i++){
            echo "<tr>
                <td>".$searchedUsers[$i]["id"]."</td>
                <td>".$searchedUsers[$i]["full_name"]."</td>
                <td>".$searchedUsers[$i]["username"]."</td>
                <td>".$searchedUsers[$i]["password"]."</td>
                <td>".$searchedUsers[$i]["email"]."</td>
                <td>".$searchedUsers[$i]["birth_date"]."</td>
                <td>".$searchedUsers[$i]["city"]."</td>
                <td><a class='btn btn-success' href='update.php?id=".$searchedUsers[$i]['id']."'>Update</a></td>
                <td><a class='btn btn-danger' href='delete.php?id=".$searchedUsers[$i]['id']."'>Delete</a></td>
             </tr>";
        }?>
    </table>



