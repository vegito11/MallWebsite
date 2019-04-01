<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  	<title> Employee Sale Records </title>
	    <link rel="stylesheet" type="text/css" href="admincss.css">
      <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  <?php
    require 'connect.inc.php';    
    $query="select concat(emp_f_name,'  ',emp_l_name) as Employee,cust_name,pro_nm,pur_date,pro_sal_price from   checkout 
            join customers on customers.cust_id=checkout.cust_id
            join employee on employee.emp_id=checkout.emp_id
            join products on products.pro_id=checkout.pro_id";     
      $empnm=$query_run="";    
      if(isset($_POST['searchbtn']))
      {
        $empnm=$_POST['empsearch'];
        $query="select concat(emp_f_name,'  ',emp_l_name) as Employee,cust_name,pro_nm,pur_date,pro_sal_price from   checkout 
            join customers on customers.cust_id=checkout.cust_id
            join employee on employee.emp_id=checkout.emp_id
            join products on products.pro_id=checkout.pro_id where concat(emp_f_name,'  ',emp_l_name) like '%$empnm%' ";

        
        if (empty($_POST["empsearch"])) 
        {
            $query="select concat(emp_f_name,'  ',emp_l_name) as Employee,cust_name,pro_nm,pur_date,pro_sal_price from   checkout 
            join customers on customers.cust_id=checkout.cust_id
            join employee on employee.emp_id=checkout.emp_id
            join products on products.pro_id=checkout.pro_id";

        }

      } 
      else  
      {
        $query="select concat(emp_f_name,'  ',emp_l_name) as Employee,cust_name,pro_nm,pur_date,pro_sal_price from   checkout 
            join customers on customers.cust_id=checkout.cust_id
            join employee on employee.emp_id=checkout.emp_id
            join products on products.pro_id=checkout.pro_id";

      }  
      $query_run=mysqli_query($conn,$query);

      

  ?>
    <a href="index.php"><input type="button" class="btn btn-primary" value="Log Out" id="lgout"></a>
    <br><br>
    <ul class="nav">
      <li><a href="Adminpage.php" >Employee List</a></li>
      <li><a href="products.php">Products List</a></li>
      <li><a href="customer.php">Customer List</a></li>
      <li><a href="expired.php">Expired Product</a></li>
      <li><a href="expire.php">Expire in 10 Days</a></li>
      <li><a href="stock.php">Product Stock</a></li>
      <li><a href="lowstock.php">Low Stock Product</a></li>
      <li><a href="custrecord.php">Customer Buy Record</a></li>
      <li><a href="emprecord.php" class="active">Employee Sale Record</a></li>      
      <li><a href="producttype.php">Products With Type </a></li>
      <li><a href="refresh.php">Refresh Expire Stock</a></li>
      <li><a href="instk.php">Increase Stock of Product</a></li>
      <li><a href="newpro.php">Add new Product</a></li> 


    </ul>
    <div class="sidebar">
          <form class="form-inline" action="emprecord.php" method="POST">
                    <input type="text" name="empsearch" size="40" class="form-control" placeholder="Search  Employee here...">
                    <button type="submit" class="btn btn-primary nav-button" name="searchbtn" value="<?php echo $empnm; ?>">Search</button>
          </form><br>
          <table class="table table-striped">
            <tr>
              <td class="head"> Employee </td>
              <td class="head"> Customer Name </td>
              <td class="head"> Product Name </th>              
              <td class="head"> Purchase Date </th>
              <td class="head"> Item Price </th>

            </tr> 
            <?php while($row=mysqli_fetch_assoc($query_run)):?> 
            <tr>
                <td><?php echo $row['Employee']?></td>
                <td><?php echo $row['cust_name']?></td>
                <td><?php echo $row['pro_nm']?></td>
                <td><?php echo $row['pur_date']?></td>
                <td><?php echo $row['pro_sal_price']?></td>

            </tr>
          <?php endwhile;?>
          </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>