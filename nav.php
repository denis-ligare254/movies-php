<?php



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>




<!-- navbar -->
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">Movie store</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
    <?php if (isset($_SESSION["logged_in"])):?>
      <li class="nav-item">
        <a class="nav-link" href="add-user.php">Add User</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add-product.php">Add Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add-customer.php">Add Customer</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Report</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sales.php">sales</a>
      </li>
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
      <!-- name of the person signed in -->
      <?= $_SESSION["names"] ?>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="logout.php">signout</a>
      </div>
    </li>
      <?php endif;?>
<!-- opposite -->
      <?php if ( !isset($_SESSION["logged_in"])):?>
      <li class="nav-item">
        <a class="nav-link" href="#">login</a>
      </li>
      <?php endif;?>
    </ul>
  </div>
</nav>