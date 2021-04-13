<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

include 'protect.php';
require 'connect.php';
$sql = "SELECT customers.names AS c_names, users.names AS u_names, products.title, sales.price , sales.date_sold FROM customers
JOIN sales ON customers.id = sales.customer_id
JOIN users ON users.id = sales.user_id
JOIN products ON products.id = sales.product_id ";

if(isset($_REQUEST["start_date"]) and isset($_REQUEST["end_date"]) ){

    $start = $_REQUEST["start_date"];
    $end =$_REQUEST["end_date"];
    $sql = "SELECT customers.names AS c_names, users.names AS u_names, products.title, sales.price , sales.date_sold FROM customers
    JOIN sales ON customers.id = sales.customer_id
    JOIN users ON users.id = sales.user_id
    JOIN products ON products.id = sales.product_id 
    WHERE sales.date_sold BETWEEN '$start' AND '$end'
    ";

  
}
$result = mysqli_query($con, $sql) or die(mysqli_error($con));// executing the query
$rows = mysqli_fetch_all($result, 1);//assoc array

mysqli_close($con);//close the connection
// last 7 days
$today = date('Y-m-d');
$last_seven = date('Y-m-d' ,strtotime('-7 days'));
$last_two_weeks = date('Y-m-d' ,strtotime('-14 days'));


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body>

<?php include 'nav.php' ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-10">
        <!-- filter input -->
        <form action="sales-report.php" class="form-inline mt-s mb-3">
        <div class="form-group">
           <label for="">start date</label>
           <input type="date" class="form-control" name="start_date" max="<?=date('Y-N-D')?>">
        </div>
        <div class="form-group ml-3">
           <label for="">end date</label>
           <input type="date" class="form-control" name="end_date" max="<?=date('Y-N-D')?>">
        </div>
        <button class="btn btn-success ml-3">Filter</button>
        <button type="reset" class="btn btn-warning ml-3">clear the field</button>
        </form>


        <a class="btn btn-sm btn-dark" href="sales-report.php?start_date=<?=$last_seven?>&end_date=<?=$today?>">Report For last 7 Days</a> 
        <a class="btn btn-sm btn-dark" href="sales-report.php?start_date=<?=$last_two_weeks?>&end_date=<?=$today?>">Report For last 14 Days</a> 
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
                    <th>CUSTOMER</th>
                    <th>SERVED BY,</th>
                    <th>TITLE</th>
                    <th>PRICE</th>
                    <th>DATE SOLD</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($rows as $sale): ?>
                    <tr>
                    <td><?=$sale['c_names']?></td>
                    <td><?=$sale['u_names']?></td>
                    <td><?=$sale['title']?></td>
                    <td><?=$sale['price']?></td>
                    <td><?=$sale['date_sold']?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                 <tfoot>
                 <th></th>
                 <th></th>
                 <th>Total sales</th>
                 <th class="total"></th>
                 <th></th>
                 </tfoot>
            </table>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.24/api/sum().js"></script> 
<script>
$('#example').DataTable( {
drawCallback: function () {
var api = this.api();
$('.total').html(
api.column( 3, {page:'current'} ).data().sum()
);
}
}); 

</script>

</body>
</html>