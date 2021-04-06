<?php

if ( isset($_REQUEST["phone"]) )
{
$names = $_REQUEST["names"];
$phone = $_REQUEST["phone"];

//connection DB
require 'connect.php';
$sql = "INSERT INTO `customers`(`id`, `names`, `phone`) VALUES (null,'names','phone')";
mysqli_query($con, $sql) or die(mysqli_error($con));

header("location:add-customer.php");
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
</head>
<body>

<div class="container">
<div class="row justify-content-center">
<div class="col-sm-5">
<form action="add-customer.php" method="post">

<div class="form-group">
<label>Names</label>
<input type="text" class="form-control" name="names" required>
</div>

<div class="form-group">
<label>Phone</label>
<input type="tel" class="form-control" name="phone" required>
</div>

<button class="btn btn-success">Add customer</button>


</form>
</div>
</div>
</div>



</body>
</html>
