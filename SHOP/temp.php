<?php


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin</title>
      <link rel="stylesheet" type="text/css" href="admincss.css">
      <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  <?php
    require 'connect.inc.php';
    $query="select * from employee";
    $empnm="";
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    { 
        if (!empty($_POST["empsearch"])) 
        {
            $empnm=$_POST["empsearch"];
        }
        else{
          
        }
    }    

    if($query_run = mysqli_query($conn,$query))    
    {

    } 
    else
    {
      echo "Query failed";
    }  

  ?>


    <a href="newuser.php"><input type="button" class="btn btn-success" value="Add new Employee " id="nwusrbtn"></a>

    <a href="index.php"><input type="button" class="btn btn-primary" value="Log Out" id="lgout"></a>
    <br><br>
    <ul class="nav">
      <li><a href="#" class="active">Employee List</a></li>
      <li><a href="products.php">Products List</a></li>
      <li><a href="customer.php">Customer List</a></li>
      <li><a href="#About">Products going to expire</a></li>
      <li><a href="#About">Customers buy record</a></li>
      <li><a href="#About">Products with low stock</a></li>
      <li><a href="#About">Add products in stock</a></li>
    </ul>
    <div class="sidebar">
          <form class="form-inline" action="Adminpage.php" method="POST">
                    <input type="text" name="empsearch" size="40" class="form-control">
                    <button type="submit" class="btn btn-primary nav-button" value="<?php echo $empnm; ?>">Search</button>
          </form><br>
          <table class="table table-striped">
            <tr>
              <td class="head"> ID </td>
              <td class="head"> Name </td>
              <td class="head"> Phone </th>
              <td class="head"> Email </th>
              <td class="head"> Salary </th>
              <td class="head"> Date of Birth </th>
              <td class="head"> Date of Joining </th>

            </tr> 
            <?php while($row=mysqli_fetch_assoc($query_run)):?> 
            <tr>
                <td><?php echo $row['emp_id']?></td>
                <td><?php echo $row['emp_f_name'].' '.$row['emp_l_name']?></td>
                <td><?php echo $row['emp_phone']?></td>
                <td><?php echo $row['emp_email']?></td>
                <td><?php echo $row['emp_sal']?></td>
                <td><?php echo $row['emp_dob']?></td>
                <td><?php echo $row['Date_joined']?></td>
            </tr>
          <?php endwhile;?>
          </table>
    </div>
    <?php 
      echo "<h1>Yout Input<h1   >";
      echo $empnm;
      echo "<br>";
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>