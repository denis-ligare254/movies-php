<?php

if ( isset($_REQUEST["password"]) )
{
$names = $_REQUEST["names"];
$email = $_REQUEST["email"];
$password = $_REQUEST["password"];
$password = password_hash($password, PASSWORD_BCRYPT);

//connection DB
$con = mysqli_connect("localhost", "root", "root", "supermarket") or die(mysqli_connect_error());
$sql = "INSERT INTO `users`(`id`, `names`, `email`, `password`) VALUES (null,'$names','$email','$password')";
mysqli_query($con, $sql) or die(mysqli_error($con));

header("location:insert.php");
}

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<title>Form</title>
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>

<div class="container">
<div class="row justify-content-center">
<div class="col-sm-5">
<form action="insert.php" method="post">

<div class="form-group">
<label>Names</label>
<input type="text" class="form-control" name="names" required>
</div>

<div class="form-group">
<label>Email</label>
<input type="email" class="form-control" name="email" required>
</div>

<div class="form-group">
<label>Password</label>
<input type="password" class="form-control" name="password" required>
</div>

<button class="btn btn-success">Add User</button>


</form>
</div>
</div>
</div>



</body>
</html>
