<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Low Stock</title>
      <link rel="stylesheet" type="text/css" href="admincss.css">
      <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <?php
      require 'connect.inc.php';
      $query="select products.pro_id,products.pro_name,st_quen ,pro_sal_price,pro_expire_dat from products join stock on products.pro_id=stock.st_id where stock.st_quen<30";
      if($query_run = mysqli_query($conn,$query))    
      {

      } 
      else
      {
        echo "Query failed";
      }  
    ?>
    <a href="index.php"><input type="button" class="btn btn-primary" value="Log Out" id="lgout"></a>
    <br><br>
    
    <ul class="nav">
      <li><a href="customerpage.php"  >Products List</a></li>
      <li><a href="c2lowstock.php" class="active">Low Stock Products</a></li>
      <li><a href="c3protype.php">Products With Type</a></li>
      <li><a href="c4tran.php">Last Transactions detail</a></li>
      <li><a href="c5buyrecord.php">Products Buy Records</a></li>
      
    </ul>
    <div class="sidebar">
          <table class="table table-striped">
            <tr>
              <td class="head"> ID </td>
              <td class="head"> Name </td>
              <td class="head"> Sale Price </th>              
              <td class="head"> Quantity Available </th>
              <td class="head"> Expire Date </th>

            </tr> 
            <?php while($row=mysqli_fetch_assoc($query_run)):?> 
            <tr>
                <td><?php echo $row['pro_id']?></td>
                <td><?php echo $row['pro_name']?></td>
                <td><?php echo $row['pro_sal_price']?></td>
                <td><?php echo $row['st_quen']?></td>
                <td><?php echo $row['pro_expire_dat']?></td>

            </tr>
          <?php endwhile;?>
          </table>
    </div>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>