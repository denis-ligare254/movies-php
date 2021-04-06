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
<form action="add-product.php" method="post" enctype="multipart/form-data">

<div class="form-group">
<label>Title</label>
<input type="text" class="form-control" name="names" required>
</div>

<div class="form-group">
<label>Description</label>
<textarea class="form-control" name="description"></textarea>
</div>
<div class="form-group">
<label>Genre</label>
<select name="genre"  class="form-control">
<options value="thriller">Thriler movies</options>
<options value="commedy">Comedy movies</options>
<options value="horror">Horror movies</options>
<options value="action">Action MOvies</options>
<options value="romance">Romance movies</options>
</select>
</div>
<!-- POSTERS -->
<div class="form-group">
<label>posters</label>
<input type="text" class="form-control-file border" name="poster" required>

</div>
<button class="btn btn-success">Add Movie</button>


</form>
</div>
</div>
</div>



</body>
</html>
