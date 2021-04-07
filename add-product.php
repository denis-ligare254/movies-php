<?php

if ( isset($_REQUEST["title"]) )
{
$title = $_REQUEST["title"];
$description = $_REQUEST["description"];
$genre = $_REQUEST["genre"];
$target_dir = "uploads/";
$target_file = $target_dir . rand(1000000,10000000)."_".basename($_FILES["poster"]["name"]);
$file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));//png jpg

if (move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file)) {
//echo "Uploaded";
$upload_status = 1; 
}
//connection DB
require 'connect.php';
$sql = "INSERT INTO `products`(`id`, `title`, `description`, `genre`, `poster`)
 VALUES (null,'$title','$description','$genre','$target_file')";

mysqli_query($con, $sql) or die(mysqli_error($con));

// header("location:add-product.php");
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
<input type="text" class="form-control" name="title" required>
</div>

<div class="form-group">
<label>Description</label>
<textarea class="form-control" name="description"></textarea>
</div>
<div class="form-group">
<label>Genre</label>
<select name="genre"  class="form-control">
<option value="thriller">Thriler movies</option>
<option value="commedy">Comedy movies</option>
<option value="horror">Horror movies</option>
<option value="action">Action MOvies</option>
<option value="romance">Romance movies</option>
</select>
</div>
<!-- POSTERS -->
<div class="form-group">
<label>posters</label>
<input type="file" accept="image/*" class="form-control-file border" name="poster" required>

</div>
<button class="btn btn-success">Add Movie</button>


</form>
</div>
</div>
</div>



</body>
</html>
