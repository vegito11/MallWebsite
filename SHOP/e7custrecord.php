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
        $query="select checkout.cust_id,customers.cust_name,sum(quen) as Total_Buy_Items,round(sum(pro_sal_price),1) as Pay_Items,pur_date from checkout join products 
        on checkout.pro_id=products.pro_id join customers on checkout.cust_id=customers.cust_id
        group by checkout.cust_id,pur_date ";

        $empnm=$query_run="";    
        if(isset($_POST['searchbtn']))
        {
          $empnm=$_POST['empsearch'];
          $query="select checkout.cust_id,customers.cust_name,sum(quen) as Total_Buy_Items,round(sum(pro_sal_price),1) as Pay_Items,pur_date from checkout join products 
        on checkout.pro_id=products.pro_id join customers on checkout.cust_id=customers.cust_id
        group by checkout.cust_id,pur_date having customers.cust_name like '%$empnm%' ";

          
          if (empty($_POST["empsearch"])) 
          {
              $query="select checkout.cust_id,customers.cust_name,sum(quen) as Total_Buy_Items,round(sum(pro_sal_price),1) as Pay_Items,pur_date from checkout join products 
        on checkout.pro_id=products.pro_id join customers on checkout.cust_id=customers.cust_id
        group by checkout.cust_id,pur_date";

          }

        } 
        else  
        {
          $query="select * from customers";$query="select checkout.cust_id,customers.cust_name,sum(quen) as Total_Buy_Items,round(sum(pro_sal_price),1) as Pay_Items,pur_date from checkout join products 
        on checkout.pro_id=products.pro_id join customers on checkout.cust_id=customers.cust_id
        group by checkout.cust_id,pur_date";

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
      <li><a href="e7custrecord.php" class="active">Customer Buy Record</a></li>
      <li><a href="e8producttype.php">Products With Type </a></li>
     <li><a href="e9insertproduct.php">Cashier Work</a></li>

    </ul>
    <div class="sidebar">
           <form class="form-inline" action="e7custrecord.php" method="POST">
                     <input type="text" name="empsearch" size="40" class="form-control" placeholder="Search  Customer here...">
                     <button type="submit" class="btn btn-primary nav-button" name="searchbtn" value="<?php echo $empnm; ?>">Search</button>
           </form><br>
          
          <table class="table table-striped">
            <tr>
              <td class="head"> ID </td>
              <td class="head"> Name </td>
              <td class="head"> Total Items Bought </th>              
              <td class="head"> Total Cost To pay </th>
              <td class="head"> Purchase Date </th>

            </tr> 
            <?php while($row=mysqli_fetch_assoc($query_run)):?> 
            <tr>
                <td><?php echo $row['cust_id']?></td>
                <td><?php echo $row['cust_name']?></td>
                <td><?php echo $row['Total_Buy_Items']?></td>
                <td><?php echo $row['Pay_Items']?></td>
                <td><?php echo $row['pur_date']?></td>

            </tr>
          <?php endwhile;?>
          </table>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>