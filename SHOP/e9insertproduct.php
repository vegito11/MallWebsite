<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Employee</title>
      <link rel="stylesheet" type="text/css" href="insert1.css">
      <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <?php 
        require 'connect.inc.php';
        $proprice=$queryrun=$empid=$custid=$proid=$qty=$pronm=$qrystockless="";
        $message="Plz Select Customer and Employee";
        $message1="Plz Select valid Product ID  ";
        $message3="Product Bought Successfully";
        $qallemp ="select * from employee order by emp_f_name";
        $qallcust ="select * from customers";
        $qrypronm=$queryrun3=$row3=$qrybuy="";
        $query_run=mysqli_query($conn,$qallemp);
        $query_run2=mysqli_query($conn,$qallcust); 
        $pronm="";
        if(isset($_POST['insertbtn']) && !empty($_POST['proid']) && !empty($_POST['qt']))
        {
            $empid=$_POST['employee'];
            $custid=$_POST['customer'];
            $proid=$_POST['proid'];
            $qty=$_POST['qt'];
            if($empid=="em" || $custid=="cu")
            {
               echo "<script type='text/javascript'>alert('$message');</script>";
            }  
            else
            {  
                $qrypronm="select pro_name,pro_sal_price from products where pro_id='$proid'";
                $queryrun3=mysqli_query($conn,$qrypronm);
                $row3=mysqli_fetch_assoc($queryrun3);
                $pronm=$row3['pro_name'];
                $proprice=$row3['pro_sal_price'];
                if($pronm=="")
                {
                  $pronm="omkar";
                  echo "<script type='text/javascript'>alert('$message1');</script>";
                } 
                else
                {
                  $qrybuy="insert into checkout values('$custid','$empid','$proid','$pronm','$qty',CURDATE(),'$proprice')";
                  //insert into checkout values(211,11,211,'NoteBook',3,CURDATE(),40  );
                  $qrystockless="update stock set st_quen=st_quen-$qty where st_id='$proid' ";
                  if(mysqli_query($conn,$qrybuy) && mysqli_query($conn,$qrystockless))
                  {
                    echo '<script type="text/javascript">'; 
                    echo 'alert("Product Bought Successfully");';
                    echo 'window.location.href = "e9insertproduct.php";';
                    echo '</script>';

                  }  
                  else
                  {
                      echo "error";
                      /*echo '<script type="text/javascript">'; 
                      echo 'alert("Error");';
                      echo 'window.location.href = "e9insertproduct.php";';
                      echo '</script>';                                    */   
                  }  
                } 
            //$qrybuy
            }   
        }        
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
      <li><a href="e8producttype.php">Products With Type </a></li>
      <li><a href="e9insertproduct.php" class="active">Cashier Work</a></li>

    </ul>
    <div class="sidebar">
        <form class="form-inline" action="e9insertproduct.php" method="POST">
             <div class="select-field">
             <select name="employee">
             <option selected hidden value="em">Select Employee</option>
                 <?php while($row=mysqli_fetch_assoc($query_run)):?>       
                      <option value="<?php  echo $row['emp_id'] ;?>" ><?php echo $row['emp_f_name'].' '.$row['emp_l_name']; ?></option>      
                 <?php endwhile;?>
             </select> 
             </div>  
             <div class="select-field2">
             <select name="customer">
             <option selected hidden value="cu">Select Customer</option>
                 <?php while($row1=mysqli_fetch_assoc($query_run2)):?>       
                      <option value="<?php  echo $row1['cust_id'] ;?>" ><?php echo $row1['cust_name']; ?></option>      
                 <?php endwhile;?>
             </select> 
             </div>  
             <br><br>&nbsp;&nbsp;&nbsp;&nbsp;
             <input type="text" name="proid" size="10" class="form-control" placeholder="Product Id">
             &nbsp;&nbsp;&nbsp;&nbsp;
             <input type="text" name="qt" size="5" class="form-control" placeholder="Quantity" maxlength="6">&nbsp;&nbsp;&nbsp;&nbsp;
             <button type="submit" class="btn btn-success nav-button" name="insertbtn" length="8" value="<?php echo $empnm; ?>">   Buy    </button>
 
        </form><br>
    
    </div>
    <?php 
      /* echo "<h1> Your INput</h1>";
        echo '<span style="color: white; font-size: 20px;">',$pronm,"</span>";        
        echo "<br>";
        echo '<span style="color: white; font-size: 20px;">',$empid,"</span>";        
        echo "<br>";
        echo '<span style="color: white; font-size: 20px;">',$custid,"</span>";
        echo "<br>";
        echo '<span style="color: white; font-size: 20px;">',$proid,"</span>";
        echo "<br>";
        echo '<span style="color: white; font-size: 20px;">',$qty,"</span>";
        echo "<br>";
        echo '<span style="color: white; font-size: 20px;">',$proprice,"</span>";
        echo "<br>";
      */
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>