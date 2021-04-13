<?php
include 'protect.php';
require 'connect.php';

if (isset($_POST["customer_id"]))
{
  
    // save purchase
    // clear out cat
    // redirect to sales page 
    $user_id= $_SESSION["id"];
    $customer_id =$_POST["customer_id"];
    $product_ids =array_unique($_SESSION["products"]);
    $date_sold = date("Y-m-d");
    $price = 50;
    
    foreach ($product_ids as $pids){
        $sql="INSERT INTO `sales`(`id`, `user_id`, `product_id`, `customer_id`, `date_sold`, `price`)
         VALUES (null,$user_id,$pids,$customer_id,'$date_sold',$price)";
        
        mysqli_query($con,$sql) or die(mysqli_error($con));
    }
$_SESSION["products"]=[];
header("location:sales.php");
}



$ids = array_unique($_SESSION["products"]);//[1,2,3]  == 1,2,3
$string = implode("," , $ids);
$sql = "SELECT * FROM products WHERE id IN($string)";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));// executing the query
$rows = mysqli_fetch_all($result, 1);//assoc array


// get customers
$sql2 = "SELECT * FROM customers ";
$result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));// executing the query
$customers = mysqli_fetch_all($result2, 1);//assoc array

mysqli_close($con);//close the connection

if (isset($_GET["id"]))
{
    //remove a movie from the cart
   $_SESSION["products"] = array_diff($_SESSION["products"], [ $_GET["id"] ] );
   header("location:checkout.php");
}

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
<form action="checkout.php" method="post"  class="form-inline mt-2 mb-2">
     <select name="customer_id" class="form-control">
     <?php foreach ($customers as $person): ?>
       <option value="<?=$person["id"]?>"><?=$person["names"]?></option>

        <?php endforeach; ?>
     
    
     </select>
     <button class="btn btn-dark">complete transaction</button>
       </form>
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
                        <td><a class="btn btn-danger btn-sm" href="checkout.php?id=<?= $movie["id"] ?>">Remove From Cart</a>
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
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>

</body>
</html>
