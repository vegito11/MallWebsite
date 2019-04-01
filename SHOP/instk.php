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
      $queryrun=$proid=$qty=$pronm=$qrystockless="";
      $message1="Plz Select valid Product ID  ";
      $message3="Product Stock Increase Successfully";
      $pronm=$row3=$qrypronm=$pronm=$queryrun3="";
      if(isset($_POST['insertbtn']) && !empty($_POST['proid']) && !empty($_POST['qt']))
      {
          $proid=$_POST['proid'];
          $qty=$_POST['qt'];
                $qrypronm="select pro_name from products where pro_id='$proid'";
                $queryrun3=mysqli_query($conn,$qrypronm);
                $row3=mysqli_fetch_assoc($queryrun3);
                $pronm=$row3['pro_name'];
              if($pronm=="")
              {
                $pronm="omkar";
                echo "<script type='text/javascript'>alert('$message1');</script>";
              } 
              else
              {
                $qrystockless="update stock set st_quen=st_quen+$qty where st_id='$proid' ";
                if(mysqli_query($conn,$qrystockless))
                {
                    echo '<script type="text/javascript">'; 
                    echo 'alert("Product Stock Increased Successfully");';
                    echo 'window.location.href = "instk.php";';
                    echo '</script>';
                }  
                
            }   
      }        
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
      <li><a href="emprecord.php">Employee Sale Record</a></li>
      <li><a href="producttype.php">Products With Type </a></li>
      <li><a href="refresh.php">Refresh Expire Stock</a></li>
      <li><a href="instk.php" class="active">Increase Stock of Prodcuts</a></li>
      <li><a href="newpro.php">Add new Product</a></li> 

    </ul>
    <div class="sidebar">
        <form class="form-inline" action="instk.php" method="POST">
             <br><br>&nbsp;&nbsp;&nbsp;&nbsp;
             <input type="text" name="proid" size="10" class="form-control" placeholder="Product Id">
             &nbsp;&nbsp;&nbsp;&nbsp;
             <input type="text" name="qt" size="5" class="form-control" placeholder="Quantity" maxlength="6">&nbsp;&nbsp;&nbsp;&nbsp;
             <button type="submit" class="btn btn-success nav-button" name="insertbtn" length="8" value="<?php echo $empnm; ?>"> Add Into Stock </button>
 
        </form><br>
    
    </div>
    <?php 
        echo "<h1> Your INput</h1>";
        echo "<font color='red'>$pronm</font>";
        echo "<br>";
        echo "<font color='red'>$proid</font>";
        echo "<br>";
        echo "<font color='red'>$qty</font>";
        echo "<br>";
        
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>