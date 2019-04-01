<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  	<title>Prodcuts Info</title>
	    <link rel="stylesheet" type="text/css" href="admincss.css">
      <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  <?php
    require 'connect.inc.php';
    $query="select * from products";
    $empnm=$query_run="";
    //$empnm='Ross';
    if(isset($_POST['searchbtn']))
    {
      $empnm=$_POST['empsearch'];
      $query="select * from products where pro_name like '%$empnm%' ";   
      
      if (empty($_POST["empsearch"])) 
      {
          $query="select * from products";
      }

    } 
    else  
    {
      $query="select * from products";
    }  
    $query_run=mysqli_query($conn,$query);

  ?>
    <a href="index.php"><input type="button" class="btn btn-primary" value="Log Out" id="lgout"></a>
    <br><br>
    <ul class="nav">
      <li><a href="AdminPage.php" >Employee List</a></li>
      <li><a href="products.php" class="active">Products List</a></li>
      <li><a href="customer.php">Customer List</a></li>
      <li><a href="expired.php" >Expired Product</a></li>
      <li><a href="expire.php" >Expire in 10 Days</a></li>
      <li><a href="stock.php" >Product Stock</a></li>
      <li><a href="lowstock.php">Low Stock Product</a></li>
      <li><a href="custrecord.php">Customer Buy Record</a></li>
      <li><a href="emprecord.php">Employee Sale Record</a></li>
      <li><a href="producttype.php">Products With Type </a></li>
      <li><a href="refresh.php">Refresh Expire Stock</a></li>
      <li><a href="instk.php">Increase Stock of Product</a></li>
      <li><a href="newpro.php">Add new Product</a></li> 

    </ul>
    <div class="sidebar">
          <form class="form-inline" action="products.php" method="POST">
                    <input type="text" name="empsearch" size="40" class="form-control"  placeholder="Search Product Here">
                    <button type="submit" class="btn btn-primary nav-button" name="searchbtn" value="<?php echo $empnm; ?>">Search</button>
          </form><br>

          <table class="table table-striped">
            <tr>
              <td class="head"> ID </td>
              <td class="head"> Name </td>
              <td class="head"> Manufacture Date </th>
              <td class="head"> Expire Date </th>
              <td class="head"> Purchase Price </th>
              <td class="head"> Sale Price </th>              

            </tr> 
            <?php while($row=mysqli_fetch_assoc($query_run)):?> 
            <tr>
                <td><?php echo $row['pro_id']?></td>
                <td><?php echo $row['pro_name']?></td>
                <td><?php echo $row['pro_manu_date']?></td>
                <td><?php echo $row['pro_expire_dat']?></td>
                <td><?php echo $row['pro_pur_price']?></td>
                <td><?php echo $row['pro_sal_price']?></td>
            </tr>
          <?php endwhile;?>
          </table>
    </div>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>