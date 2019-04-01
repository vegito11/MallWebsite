<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Employee</title>
      <link rel="stylesheet" type="text/css" href="protype.css">
      <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
     <?php
       require 'connect.inc.php';
       $query="select pro_name,pro_sal_price,pro_expire_dat,st_quen from stock
               join products on products.pro_id=stock.st_id
               where st_type='Cookies' ";
       $type=$query_run="";
       //$empnm='Ross';
       if(isset($_POST['Submit']))
       {
         $type=$_POST['protype'];
         $query="select pro_name,pro_sal_price,pro_expire_dat,st_quen from stock
               join products on products.pro_id=stock.st_id
               where st_type like '%{$type}%' ";   
         
         if (($_POST["protype"])=="Type") 
         {
             $query="select pro_name,pro_sal_price,pro_expire_dat,st_quen from stock
               join products on products.pro_id=stock.st_id
               where st_type='Cookies'";
         }

       } 
       else  
       {
         $query="select pro_name,pro_sal_price,pro_expire_dat,st_quen from stock
               join products on products.pro_id=stock.st_id
               where st_type='Cookies'";
       }  
       $query_run=mysqli_query($conn,$query);

     ?> 
    <a href="index.php"><input type="button" class="btn btn-primary" value="Log Out" id="lgout"></a>
    <br><br>
    <ul class="nav">
      <li><a href="employeepage.php" >Employee Homepage</a></li>
      <li><a href="e1products.php">Products List</a></li>
      <li><a href="e2customer.php">Customer List</a></li>
      <li><a href="e3expired.php">Expired Product</a></li>
      <li><a href="e4expire.php">Expire in 10 Days</a></li>
      <li><a href="e5stock.php">Product Stock</a></li>
      <li><a href="e6lowstock.php" >Low Stock Product</a></li>
      <li><a href="e7custrecord.php">Customer Buy Record</a></li>
      <li><a href="e8producttype.php" class="active">Products With Type </a></li>
      <li><a href="e9insertproduct.php">Cashier Work</a></li>

    </ul>
    <div class="sidebar">
        <form action="e8producttype.php" class="form-inline" method="POST">
        <div class="select-field">                    
          <select name="protype">
            <option selected hidden >Type</option>
            <option value="Cookies">Cookies</option>
            <option value="daily use">Daily Use</option>
            <option value="Crackers">Crackers</option>
            <option value="Household">Household</option>
            <option value="fruit">Fruit</option>
            <option value="Vegetable">Vegetable</option>
            <option value="School Stationary">School Stationary</option>
            <option value="Beverages">Beverages</option>
            <option value="Refrigerated Food">Refrigerated Foods</option>
            <option value="Canned & Packaged Foods">Canned And Packaged</option>
            <option value="Bakery Breakfast Cereal">Bakery And Breakfast</option>
            <option value="toy">Toy</option>
          </select>
          <button type="submit" class="btn btn-primary nav-button" name="Submit" value="<?php echo $type; ?>">Search</button>

        </div>  
        </form>
        <br>
        <table class="table table-striped">
          <tr>
            <td class="head"> Product Name </th>              
            <td class="head"> Item Price </th>
            <td class="head"> Quantity Available </td>              
            <td class="head"> Expire Date </th>
          </tr> 
          <?php while($row=mysqli_fetch_assoc($query_run)):?> 
          <tr>
              <td><?php echo $row['pro_name']?></td>
              <td><?php echo $row['pro_sal_price']?></td>                
              <td><?php echo $row['st_quen']?></td>
              <td><?php echo $row['pro_expire_dat']?></td>

          </tr>
        <?php endwhile;?>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>