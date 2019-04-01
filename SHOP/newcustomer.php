<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
    .error {color: red;}
    </style>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="newusercss.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  <?php 
        require 'connect.inc.php';
        $gen=$fnm=$phn=$mail=$salary=$birth=$add=$birth=$qryid=$qryidrow=$custid=$id=" ";
        $gErr=$nErr=$pErr=$eErr=$sErr=$aErr="";
        $message1="New Customer Added Successfully";  
        $qrynewem="";
        $qryid='select cust_id from customers order by cust_id desc limit 1';
        $result =mysqli_query($conn,$qryid);

        if(isset($_POST['reg']))
        {
            if($_POST["gender"] =="a") 
            {
                $gErr="Gender Should not be empty";
            }  
            if(empty($_POST["email"]) ) 
            {
                $eErr="Email Should not be empty";
            }  
            if(empty($_POST['fname'])) 
            {
                $nErr="Please Enter the Customer Name";
            }  
            if(empty($_POST['phone'])) 
            {
                $pErr="Phone Number Should not be empty";
            }  
            if(empty($_POST["adress"]) ) 
            {
                $aErr="Please Give the Adress of Employee";
            }
            else
            {
                $gen=$_POST['gender'];
                $fnm=$_POST['fname'];
                $phn=$_POST['phone'];
                $mail=$_POST['email'];
                $add=$_POST['adress'];
                while($row=mysqli_fetch_array($result))
                {
                  $id=$row['cust_id'];
                }  
                $custid=$id+1;
                $qrynewem="insert into customers
                values('$custid','$fnm','$phn','$add','$mail','$gen',curdate(),curdate())";
                //mysql_query($qrynewem) OR die("Error:".mysql_error());
                if(mysqli_query($conn,$qrynewem))
                {
                   echo "<script type='text/javascript'>alert('$message1');</script>";
                   header("location:employeepage.php");

                }
                else
                {
                  echo "fail";
                }  
            }  
        }  
  ?>
      <div class="loginbox">
      <h1 id="whitecol">Sign Up</h1><br>
      <div class="container">
            <form action="newcustomer.php" class="form-inline" method="POST">
                  <div class="form-group has-success has-feedback">
                      <label for="element2" class="control-label" id="whitecol">Name :</label>
                      &nbsp;&nbsp;&nbsp;
                      <input type="text" size="30" id="element2" class="form-control" placeholder="Enter Customer Name " name="fname" value=<?php echo $fnm;?>>
                      
                      <br>
                  </div>
                      <span class="error">* <?php echo $nErr;?></span>
                        <br><br>
                     
                  <div class="form-group has-error has-feedback">
                      <label for="element1" class="control-label" id="whitecol" >Adress : </label>
                      &nbsp;
                      <input type="text" id="element1" class="form-control" maxlength="80" size="50" placeholder="Enter Adress" name="adress" value=<?php echo $add;?>>

                      <span class="error">* <?php echo $aErr;?></span>
                  </div>
                  				&nbsp;<br><br>
                  <div class="form-group">
                      <label for="element2" class="control-label" id="whitecol">Phone &nbsp;:&nbsp;&nbsp; </label>

                      <input type="digit" id="element2" class="form-control" maxlength="13" size="30" placeholder=" Enter Phone Number" name="phone" value=<?php echo $phn ;?>>
                      <span class="error">* <?php echo $pErr;?></span>
                  </div>
                      <br><br>
                  <div class="form-group">
                      <label for="element2" class="control-label" id="whitecol">Email &nbsp;:&nbsp;&nbsp; </label>
                      &nbsp;  
                      <input type="text" id="element2" class="form-control" maxlength="25" size="30" placeholder="Enter Email Adress" name="email" value=<?php echo $mail;?>>
                      <span class="error">* <?php echo $eErr;?></span>
                  </div>
                    <br><br>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
                     <div class="select-field">                    
                       <select name="gender">
                         <option selected hidden value="a" >Gender</option>
                         <option value="M">Male</option>
                         <option value="F">Female</option>
                         </select>
                         <span class="error">* <?php echo $gErr;?></span>
                     </div>
                   <br><br><br>
                        
              <input type="submit" class="btn-lg btn-success " id="right" value="Register" name="reg">
            
            </form>
             <?php
          /*   
                 echo "<h2>Your Input:</h2>";
                 echo "<font color='red'>$gen</font>";
                 echo "<br>";
                 echo "<font color='red'>$phn</font>";
                 echo "<br>";
                 echo "<font color='red'>$add</font>";
                 echo "<br>";
                 echo "<font color='red'>$mail</font>";
                 echo "<br>";
                 echo "<font color='red'>$fnm</font>";
                 echo "<br>";
                 echo "<font color='red'>$custid</font>";
                 echo "<br>";
            */     
             ?>

      </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>