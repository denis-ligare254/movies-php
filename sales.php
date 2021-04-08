<?php


require 'connect.php';
//$con = mysqli_connect("localhost","root","root","complete") or die(mysqli_connect_error());
$sql = "SELECT * FROM users";
$result = mysqli_query($con, $sql) or die( mysqli_error($con) );// executing the query
$rows = mysqli_fetch_all($result, 1);//assoc array
mysqli_close($con);//close the connection

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10">

                <?php if( isset($_COOKIE['message']) ) : ?>
                    <div class="alert alert-dark text-center text-white">
                        <?= str_replace("+"," ", $_COOKIE['message']) ?>
                    </div>
                <?php endif; ?>

                <table id="example" class="table table-striped table-bordered">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Names</th>
                            <th>Email</th>
                            <th>Delete User</th>
                            <th>Update</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($rows as $user): ?>
                             <tr>
                                 <td> <?= $user["id"] ?> </td>
                                 <td> <?= $user["names"] ?> </td>
                                 <td> <?= $user["email"] ?> </td>
                                 <td> <a class="btn btn-danger btn-sm" href="delete.php?id=<?=$user["id"]?>">Delete</a>  </td>
                                 <td> <a class="btn btn-info btn-sm" href="update.php?id=<?=$user["id"]?>">Update</a>  </td>
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
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>

</body>
</html>