<?php
 session_start();
require 'Super_Admin.php';
$obj_sup = new Super_Admin();
if (isset($_GET['status'])) {
    if (isset($_GET['logout']) == 'true') {
        $obj_sup->logout();
    }
}
$user_id = $_SESSION['user_id'];
if ($user_id == NULL) {
    header('Location: login.php');
}
include('DBconn.php'); 



?>
<html>
<head>
<title>Order List</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/navigation.css" type="text/css" />
<link rel="stylesheet" href="css/backend.css" type="text/css" />
<link rel="stylesheet" href="css/hoverstyle.css" type="text/css"/>
<style>
a[name="panel"]:hover {
	background-color: #666;
	cursor: default;
}
</style>

</head>
<body bgcolor="#a1887f">
<div id="main">
<ul>
  <li><a href="?status=logout&logout=true" > Sign Out</a></li> 
   
   <li class="dropdown" >
    <a href="#" class="dropbtn" >Upload</a>
    <div class="dropdown-content">
      <?php echo "<a href=\"upload.php?id=1\">Desktop & Laptop</a>"?>
      <?php echo "<a href=\"upload.php?id=2\">Mobile & Tab</a>"?>
      <?php echo "<a href=\"upload.php?id=3\">Accessories</a>"?>
	</div>
   </li>    
   <li style="float:left"><a href="admin_panel.php" name="panel">Admin Panel</a></li> 
   <li><a href="order_list.php" class="active">Order List</a></li>  
</ul>
<hr>
<div id="sd1">
<?php 
$result = mysql_query("SELECT SUM(price) AS TotalItemsOrdered FROM order_list"); 
$row = mysql_fetch_assoc($result); 
echo "<br><p style='color:#3e2723'>Total Sell</p>"."<p style='font-size:25px'>".$sum = $row['TotalItemsOrdered']." Tk. </p>";
?>
<form method="post" action="#" ><br><br><br>
<p style="font-size:25px">Head Liner</p>
<textarea name="news"> </textarea><br><br>
<input type="submit" name="set" value="Set News"/>
</form>
</div>


<div id="content" align="center">
<table width="1050" class="product-table">
<tr bgcolor="#8d6e63 " style="color:#FFF"><td width="96" align="center" >Order ID</td><td width="181">Customer Name</td><td width="177"> E-mail</td><td width="214">Product Title</td><td width="167">Product ID</td><td width="186" align="center">Delivery</td></tr>
   
   
   <?php
   	   include('DBconn.php');
       $sql = "SELECT order_id,customer_name,email_address,product_title,product_id FROM `order_list` where delivery=0";
	   $result=$conn->query($sql);
	   while($row=$result->fetch_assoc())
	   {	   
	?>
	  
  
   
   <tr >
   <td><?php echo $row['order_id'];?></td>
   <td> <?php echo $row['customer_name'];?></td>
 
   <td><?php echo $row['email_address'];?></td>
   <td><?php echo $row['product_title'];?></td>
   <td><?php echo $row['product_id'];?></td>
   
  
<?php echo "<td align='center' bgcolor='#efebe9'> <a style='text-decoration:none' href=\"delivery_product.php?id=$row[order_id]\" onClick=\"return confirm('Order Delivery Sucessfully Done !!!')\">Done</a>
</td>" ?>
   </tr>
	   <?php }?>
   </table>

</div>

</body>
</html>

<?php
include('DBconn.php');
if(isset($_POST['set']))
{
	$headliner = $_POST['news'];
	
	$sql = "UPDATE `headliner` SET `news`='$headliner'";	
	if(mysqli_query($conn,$sql))
  {
	  //mysqli_query($conn,$sql1);
	header('Location:order_list.php');
  }
  else
  {
	  echo"Sql Error".$sql;
	 // echo"Sql Error".$sql1;
  }


}
?>