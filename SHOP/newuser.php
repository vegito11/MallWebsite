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
        $gen=$fnm=$lnm=$phn=$mail=$salary=$birth=$add=$birth=$qryid=$qryidrow=$empid=$id=" ";
        $gErr=$nErr=$pErr=$eErr=$sErr=$aErr="";
        $bmax=date("Y-M-D");
        $message1="New Employee Added Successfully";  
        $qrynewem="";
        $qryid='select emp_id from employee order by emp_id desc limit 1';
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
            if(empty($_POST['fname']) || empty($_POST["lname"])) 
            {
                $nErr="FirstName and LastName Should not be empty";
            }  
            if(empty($_POST['phone'])) 
            {
                $pErr="Phone Number Should not be empty";
            }  
            if(empty($_POST["sal"])) 
            {
                $sErr="Please fill the Salary box";
            }  
            if(empty($_POST["adress"]) ) 
            {
                $aErr="Please Give the Adress of Employee";
            }
            if(empty($_POST["bday"]) ) 
            {
                $aErr="Please Give the Birth Date of Employee";
            }

            else
            {
                $gen=$_POST['gender'];
                $fnm=$_POST['fname'];
                $lnm=$_POST['lname'];
                $phn=$_POST['phone'];
                $mail=$_POST['email'];
                $salary=$_POST['sal'];
                $add=$_POST['adress'];
                $birth=$_POST['bday'];

                while($row=mysqli_fetch_array($result))
                {
                  $id=$row['emp_id'];
                }  
                $empid=$id+1;
                $qrynewem="insert into employee values('$empid','$fnm','$lnm','$add','$phn','$mail','$salary','$birth','$gen',curdate())";
                if(mysqli_query($conn,$qrynewem))
                {
                   echo "<script type='text/javascript'>alert('$message1');</script>";
                   header("location: Adminpage.php");

                }  
            }  
        }  
  ?>
      <div class="loginbox">
      <h1 id="whitecol">Sign Up</h1><br>
      <div class="container">
            <form action="newuser.php" class="form-inline" method="POST">
                  <div class="form-group has-warning has-feedback">
                      <label for="element1" class="control-label" id="whitecol">FirstName : </label>
                    
                      <input type="text" id="element1" class="form-control" maxlength="10" size="20" placeholder="Enter FirstName" name="fname" value=<?php echo $fnm ;?>>
                      <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                     
                  </div>
                  
                  <div class="form-group has-success has-feedback">
                      <label for="element2" class="control-label" id="whitecol">Lastname : </label>
                      
                      <input type="text" size="20" id="element2" class="form-control" placeholder="Enter Lastname" name="lname" value=<?php echo $lnm ;?>>
                      <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                      <br>
                  </div>
                      <span class="error">* <?php echo $nErr;?></span>
                        <br><br>
                     
                  <div class="form-group has-error has-feedback">
                      <label for="element1" class="control-label" id="whitecol" >Adress : </label>
                      &nbsp;
                      <input type="text" id="element1" class="form-control" maxlength="80" size="50" placeholder="Enter Adress" name="adress" value=<?php echo $add ;?>>
                      <span class="glyphicon glyphicon-ok form-control-feedback"></span>
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
                      <input type="text" id="element2" class="form-control" maxlength="25" size="30" placeholder="Enter Email Adress" name="email" value=<?php echo $mail ;?>>
                      <span class="error">* <?php echo $eErr;?></span>
                  </div>
                    <br><br>
                  <div class="form-group">
                      <label for="element2" class="control-label" id="whitecol" >Salary &nbsp;:&nbsp;&nbsp; </label>

                      <input type="text" id="element2" class="form-control" maxlength="8" size="10" placeholder="Enter Salary" name="sal" value=<?php echo $salary ;?>>
                      <span class="error">* <?php echo $sErr;?></span>
                      
                  </div>
                  <br><br>
                  
                  <label id="whitecol">Birthday:</label>
                
                  <input type="date" name="bday" max=<?php echo $bmax ?>>
                     <br><br>
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
                 echo "<font color='red'>$lnm</font>";
                 echo "<br>";
                 echo "<font color='red'>$phn</font>";
                 echo "<br>";
                 echo "<font color='red'>$salary</font>";
                 echo "<br>";
                 echo "<font color='red'>$add</font>";
                 echo "<br>";
                 echo "<font color='red'>$mail</font>";
                 echo "<br>";
                 echo "<font color='red'>$fnm</font>";
                 echo "<br>";
                 echo "<font color='red'>$birth</font>";
                 echo "<br>";
                 echo "<font color='red'>$empid</font>";
                 echo "<br>";
            */     
             ?>

      </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>