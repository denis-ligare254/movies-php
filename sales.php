<?php
include 'protect.php';
require 'connect.php';
$sql = "SELECT * FROM products";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));// executing the query
$rows = mysqli_fetch_all($result, 1);//assoc array

mysqli_close($con);//close the connection
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body>

<?php include 'nav.php' ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <?php
                  if (isset($_SESSION["products"]))
                  $movie_count = count( array_unique($_SESSION["products"]) );
                         //               
              
            ?>
 
            <div class="row border mt-2 mb-2 p-2">
                <div class="col-6 m-auto text-center">
                    You have <?= $movie_count ?? 0 ?> movies in the cart.
                </div>
     
                <div class="col-6 text-center">
                    <a href="checkout.php" class="btn btn-success btn-sm">Checkout</a>
                </div>
            </div>

            <table id="example" class="table table-striped table-bordered">

                <thead>
                <tr>
                    <th>TITLE</th>
                    <th>GENRE</th>
                    <th>DESCRIPTION</th>
                    <th>POSTER</th>
                    <th>ACTION</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($rows as $movie): ?>
                    <tr>
                        <td> <?= $movie["title"] ?> </td>
                        <td> <?= $movie["genre"] ?> </td>
                        <td> <?= $movie["description"] ?> </td>
                        <td><img src="<?= $movie['poster'] ?>" width="60" height="60" alt="<?= $movie["title"] ?>"></td>
                        <td><a class="btn btn-info btn-sm" href="add-to-cart.php?id=<?= $movie["id"] ?>">Add To Cart</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>

</body>
</html>