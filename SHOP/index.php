<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    .error {color: #FF0000;}
    </style>
    <title>Log In</title>
      <link rel="stylesheet" type="text/css" href="indexcss.css">
      <link rel="stylesheet" type="text/css" href="shopstyle.css">
      <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <?php   
          $name = $query_row = $gender =$pass= "";
          $testuser=$testpass="def";
          $nameErr=$passErr=$priv=$privErr="";
          $priv="omkar";
          require 'connect.inc.php';
          $query="select * from login";
          $query_run = mysqli_query($conn,$query) or die(mysqli_error());
            //echo 'connected <br >';
          //echo '<span style="color: white; font-size: 20px;">',$query_run,"</span>";

           if ($_SERVER["REQUEST_METHOD"] == "POST") 
           { 
              if (empty($_POST["name"])  ) 
              {
                  $nameErr="Username should not be empty";                                                
              }
              if(empty($_POST["pass"])) 
              {
                  $passErr="Password Should not be empty";  
              }  
              if($_POST["gender"]=="Privilage")
              {
                $privErr="Please Select Privilage";
              }  
              else 
              {
                    while($query_row = mysqli_fetch_assoc($query_run)) 
                    {
                      $name=$_POST["name"];
                      $pass=$_POST["pass"];
                      $priv=$_POST["gender"];
                      $testuser=$query_row['log_username'];
                      $testpass=$query_row['log_password'];
                      
                        if($name==$query_row['log_username'])
                        {
                             
                            if($pass==$query_row['log_password'])
                            {
                                 
                                if($priv==$query_row['log_type'])
                                {
                                   
                                   if($priv=='Customer')                               
                                   {
                                     header("Location:customerpage.php"); 
                                   }
                                   else if($priv=="Employee")
                                   {                               
                                      
                                      header("Location:employeepage.php"); 
                                   }   
                                   else if($priv=="Admin")
                                    header("Location:Adminpage.php"); 
                                }  
                            }  
                        }  
                    } 
              }
          }  
    ?>
  

      <div class="loginbox1">
            <h1 id="whitecol">Log In</h1>
           
            <form action="index.php" class="form-inline" method="POST">
                  <div class="select-field">                    
                    <select name="gender">
                      <option selected hidden >Privilage</option>
                      <option value="Admin">Admin</option>
                      <option value="Customer">Customer</option>
                      <option value="Employee">Employee </option>
                    </select>
                    <span class="error">* <?php echo $privErr;?></span>
                  </div>
                        <br><br>
                
                  <div class="form-group ">
                      <label for="element1" class="control-label" id="whitecol" >Username &nbsp;:&nbsp;&nbsp; </label>
                      
                      <input type="text" id="element1" class="form-control" maxlength="15" size="20" placeholder="Username" name="name" value="<?php echo $name;?>">
                     
                      <span class="error">* <?php echo $nameErr;?></span>
                  </div>
                     <br><br>
                
                  <div class="form-group has-error">
                      <label for="element2" class="control-label" id="whitecol"> Password &nbsp;: </label>
                      &nbsp;&nbsp;
                      <input type="password" id="element2" class="form-control" maxlength="15" size="20" placeholder="password" name="pass" value="<?php echo $pass;?>">                    
                      <span class="error">* <?php echo $passErr;?></span>
                  </div>
                  &nbsp;
                  <br><br>
            <a href="Adminpage.html"><input type="submit" name="submit" class="btn-lg btn-success " id="right" value="Log In"></a>
            </form>
            <br>
      </div>
      <?php
      
      echo "<h2>Your Input:</h2>";
      echo '<span style="color: white; font-size: 20px;">',$priv,"</span>";
      echo "<br>";
      echo '<span style="color: white; font-size: 20px;">',$name,"</span>";
      echo "<br>";
      echo '<span style="color: white; font-size: 20px;">',$pass,"</span>";
      echo "<br>TEST:";
      echo '<span style="color: white; font-size: 20px;">',$testuser,"</span>";
      echo "<br>";
      echo '<span style="color: white; font-size: 20px;">',$testpass,"</span>";
      

      
      ?>
      </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>