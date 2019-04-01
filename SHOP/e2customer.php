<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Employee</title>
      <link rel="stylesheet" type="text/css" href="admincss.css">
      <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <?php
      require 'connect.inc.php';
      $query="select * from customers";
      $empnm=$query_run="";
      //$empnm='Ross';
      if(isset($_POST['searchbtn']))
      {
        $empnm=$_POST['empsearch'];
        $query="select * from customers where cust_name like '%$empnm%' ";   
        
        if (empty($_POST["empsearch"])) 
        {
            $query="select * from customers";
        }

      } 
      else  
      {
        $query="select * from customers";
      }  
      $query_run=mysqli_query($conn,$query);

    ?>
    <a href="index.php"><input type="button" class="btn btn-primary" value="Log Out" id="lgout"></a>
    <br><br>
    <ul class="nav">
      <li><a href="employeepage.php" >Employee Homepage</a></li>
      <li><a href="e1products.php">Products List</a></li>
      <li><a href="e2customer.php" class="active">Customer List</a></li>
      <li><a href="e3expired.php">Expired Product</a></li>
      <li><a href="e4expire.php">Expire in 10 Days</a></li>
      <li><a href="e5stock.php">Product Stock</a></li>
      <li><a href="e6lowstock.php">Low Stock Product</a></li>
      <li><a href="e7custrecord.php">Customer Buy Record</a></li>
      <li><a href="e8producttype.php">Products With Type </a></li>
      <li><a href="e9insertproduct.php">Cashier Work</a></li>

    </ul>
    <div class="sidebar">
          <form class="form-inline" action="e2customer.php" method="POST">
                    <input type="text" name="empsearch" size="40" class="form-control" placeholder="Search  Customer here...">
                    <button type="submit" class="btn btn-primary nav-button" name="searchbtn" value="<?php echo $empnm; ?>">Search</button>
          </form><br>

          <table class="table table-striped">
            <tr>
              <td class="head"> ID </td>
              <td class="head"> Name </td>
              <td class="head"> Phone </th>
              <td class="head"> Email </th>
              <td class="head"> Gender </th>
              <td class="head"> First Shopping </th>
              <td class="head"> Last Shopping </th>

            </tr> 
            <?php while($row=mysqli_fetch_assoc($query_run)):?> 
            <tr>
                <td><?php echo $row['cust_id']?></td>
                <td><?php echo $row['cust_name']?></td>
                <td><?php echo $row['cust_phone']?></td>
                <td><?php echo $row['cust_email']?></td>
                <td><?php echo $row['cust_gen']?></td>
                <td><?php echo $row['cust_date']?></td>
                <td><?php echo $row['cust_active']?></td>
            </tr>
          <?php endwhile;?>
          </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>