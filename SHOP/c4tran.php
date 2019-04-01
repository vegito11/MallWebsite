<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Customer</title>
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
      <li><a href="customerpage.php">Products List</a></li>
      <li><a href="c2lowstock.php">Low Stock Products</a></li>
      <li><a href="c3protype.php">Products With Type</a></li>
      <li><a href="#" class="active">Last Transactions detail</a></li>
      <li><a href="c5buyrecord.php">Products Buy Records</a></li>
      
    </ul>
     <div class="sidebar">
           <form class="form-inline" action="c4tran.php" method="POST">
                     <input type="text" name="empsearch" size="40" class="form-control" placeholder="Enter Your Name">
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
    </div>ss
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>