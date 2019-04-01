<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Expired</title>
      <link rel="stylesheet" type="text/css" href="admincss.css">
      <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  <?php
    require 'connect.inc.php';
    $qryrefresh=$days=$qryrefstock=$stockadd=$row1=$qrystockcheck=$proid=$d1=$d2="";
    $message1="Stock Refreshed Successfully :)";
    $query="select * from products where pro_expire_dat <curdate()";
    $qryexpire=mysqli_query($conn,$query);
    if(isset($_POST['refreshbtn']))
    {  
          if($query_run = mysqli_query($conn,$query))    
          {
              while($row=mysqli_fetch_assoc($query_run))
              {
                $proid=$row['pro_id'];
                $qryrefresh="update products set
                  pro_expire_dat=date_add(curdate(), interval (datediff(pro_expire_dat,pro_manu_date)) day),
                  pro_manu_date=curdate()
                  where pro_id='$proid'";
                  if(mysqli_query($conn,$qryrefresh))
                  {  
                      echo "<script type='text/javascript'>alert('$message1');</script>";
                  }    
              }
          } 
          else
          {
            echo "Query failed";
          }  
      }    

  ?>


    <a href="index.php"><input type="button" class="btn btn-primary" value="Log Out" id="lgout"></a>
    <br><br>
    <ul class="nav">
      <li><a href="AdminPage.php" >Employee List</a></li>
      <li><a href="products.php">Products List</a></li>
      <li><a href="customer.php">Customer List</a></li>
      <li><a href="expired.php"  >Expired Product</a></li>
      <li><a href="expire.php">Expire in 10 Days</a></li>
      <li><a href="stock.php">Product Stock</a></li>
      <li><a href="lowstock.php">Low Stock Product</a></li>
      <li><a href="custrecord.php">Customer Buy Record</a></li>
      <li><a href="emprecord.php">Employee Sale Record</a></li>
      <li><a href="producttype.php" >Products With Type </a></li>
      <li><a href="refresh.php" class="active">Refresh Expire Stock</a></li>
      <li><a href="instk.php">Increase Stock of Product</a></li>
      <li><a href="newpro.php">Add new Product</a></li> 

      
    </ul>
    <div class="sidebar">
          <form class="form-inline" action="refresh.php" method="post">
            <button type="submit" class="btn btn-success nav-button" name="refreshbtn" value="<?php echo $empnm; ?>"> Refresh Expired Stock  </button>
          </form>
          <br>
          <table class="table table-striped">
            <tr>
              <td class="head"> ID </td>
              <td class="head"> Name </td>
              <td class="head"> Manufacture Date </th>
              <td class="head"> Expire Date </th>
              <td class="head"> Purchase Price </th>
              <td class="head"> Sale Price </th>              

            </tr> 
            <?php while($row=mysqli_fetch_assoc($qryexpire)):?> 
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
    <?php 
      echo "<h1>Yout Input<h1   >";
      echo "<font color='red'>$days</font>";
      echo "<br>";
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>