<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    .error {color:white;
      size: 30px
      font:30px;
    }
    </style>

  	<title>Admin</title>
	    <link rel="stylesheet" type="text/css" href="insertprocss.css">
      <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  <?php 
      require 'connect.inc.php';
      $queryrun=$pprice=$sprice=$edate=$proid=$qty=$pronm=$mdate=$ptype=$bname="";
      $Err=$err=$Eerr="";
      $bmax=date("Y-M-D");
      $message="Plz Select Product Type ";
      $message1="Plz Enter Prices and Brand name  ";
      $message3="Product Added Successfully";
      $qproid ="select pro_id from products order by pro_id  desc limit 1";
      $qrypro=$queryrun3=$row3=$qrystock="";
      $query_run=mysqli_query($conn,$qproid);
      $pronm="";
      if(isset($_POST['regbtn']))
      {
          $pronm=$_POST['proid'];
          $qty=$_POST['qt'];
          $ptype=$_POST['ptype'];
          if(empty($_POST['proid']) || empty($_POST['qt']))
          {
              $Eerr="Please Select product name and quantity";
          }  
          if($ptype=="a")
          {
             echo "<script type='text/javascript'>alert('$message');</script>";
          }  
          if(empty($_POST['pprice']) || empty($_POST['sprice']) || empty($_POST['bname']))
          {
             $Err="Plz Enter Prices and Brand name ";             
          }
          if(empty($_POST['mdate']) || empty($_POST['edate']))
          {
            $err="Please Select Dates";
          }  
          else
          {
            $ptype=$_POST['ptype'];
            $pronm=$_POST['proid'];
            $qty=$_POST['qt'];
            $pprice=$_POST['pprice'];
            $sprice=$_POST['sprice'];
            $bname=$_POST['bname'];
            $mdate=$_POST['mdate'];
            $edate=$_POST['edate'];
            while($row3=mysqli_fetch_assoc($query_run))
            {
              $proid=$row3['pro_id'];
            }  
            $proid=$proid+1;
            if(!(is_numeric($qty)))
            {
              $Eerr="Quantity Should be integer ";
            }
            else
            {
                  if(!(is_numeric($pprice)) || !(is_numeric($sprice)))
                  {
                    $Err="Prices Should be integer ";
                  }
                  else
                  {
                        $qrypro="insert into products values('$proid','$pronm','$mdate','$edate','$pprice','$sprice')";
                        $qrystock="insert into stock values('$proid','$pronm','$bname','$ptype','$qty')";
                        if(mysqli_query($conn,$qrypro) && mysqli_query($conn,$qrystock))  
                        {
                          echo '<script type="text/javascript">'; 
                          echo 'alert("Product Added Successfully");';
                          echo 'window.location.href = "newpro.php";';
                          echo '</script>';
                        }  
                  }  

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
      <li><a href="instk.php" >Increase Stock of Prodcuts</a></li>
      <li><a href="newpro.php" class="active">Add new Product</a></li> 

    </ul>
    <div class="sidebar">
        <form class="form-inline" action="newpro.php" method="POST">
        <div class="select-field">                    
          <select name="ptype">
            <option selected hidden value="a" >Select Type</option>
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
        </div> &nbsp;&nbsp;&nbsp;&nbsp; 
                <input type="text" name="proid" size="30" class="form-control" placeholder="Enter Product Name" value=<?php echo $pronm;?>>&nbsp;&nbsp;&nbsp;&nbsp;        
             <input type="text" name="qt" size="5" class="form-control" placeholder="Quantity" maxlength="6"><span class="error" value=<?php echo $qty;?>>* <?php echo $Eerr;?></span>&nbsp;&nbsp;&nbsp;&nbsp;<br><br>&nbsp;&nbsp;&nbsp;&nbsp;
              <label id="whitecol">Manufacturing Date:</label>              
              <input type="date" name="mdate" max=<?php echo $bmax ?> value=<?php echo $mdate;?>>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <label id="whitecol">Expire Date:</label>              
              <input type="date" name="edate" min=<?php echo $bmax ?> value=<?php echo $edate;?>><span class="error">* <?php echo $err;?></span><br><br>
              &nbsp;&nbsp;&nbsp;&nbsp;        
              <input type="text" name="pprice" size="10" maxlength="8" class="form-control" placeholder="Purchase Price" value=<?php echo $pprice;?>>&nbsp;&nbsp;&nbsp;&nbsp;        
              <input type="text" name="sprice" size="10" maxlength="8" class="form-control" placeholder="Sale Price" value=<?php echo $sprice;?>>&nbsp;&nbsp;&nbsp;&nbsp;        
              <input type="text" name="bname" size="20" maxlength="18" class="form-control" placeholder="Brand Name" value=<?php echo $bname;?>> <span class="error" >* <?php echo $Err;?></span><br><br>&nbsp;&nbsp;&nbsp;&nbsp; 
             
             <button type="submit" class="btn btn-success nav-button" name="regbtn" length="8" value="<?php echo $empnm; ?>">   Add new Product    </button>

        </form><br>
    
    </div>
    <?php 
      /*  echo "<h1> Your INput</h1>";
        echo "<font color='red'>$ptype</font>";
        echo "<br>";
        echo "<font color='red'>$proid</font>";
        echo "<br>";
        echo"<font color='red'>$qty</font>";
        echo "<br>";
        echo "<font color='red'>$pprice</font>";
        echo "<br>";
        echo "<font color='red'>$sprice</font>";
        echo "<br>";
        echo "<font color='red'>$bname</font>";
        echo "<br>";
        echo "<font color='red'>$mdate</font>";
        echo "<br>";
        echo "<font color='red'>$edate</font>";
        echo "<br>";
        */
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>