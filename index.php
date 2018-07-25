<?php 
$query=mysql_connect("localhost","root",""); 
mysql_select_db("ecommerce",$query); 

?> 

<?php 
//$user_id= '1' ;
include('DBconn.php');


if (isset($_POST['buy']) || isset($_POST['add_to_cart']) )
 {
	session_start();
	require 'Super_Admin.php';
	$obj_sup = new Super_Admin();
	if (isset($_GET['status'])) {
		if (isset($_GET['logout']) == 'true') {
			$obj_sup->logout();
		}
	}	
	$user_id = $_SESSION['user_id'];
	if ($user_id == NULL) 
	{
		header('Location: login.php');
	}
	else
	{		
		header('Location: buy.php');		
	}
	$result = $obj_sup->select_user_by_email_address($_SESSION['user_id']);
	$client_info = mysql_fetch_assoc($result);
	
	
}

?>

<!DOCTYPE html>
<head>
<head>
<title>Index</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/text.css" type="text/css" />
<link rel="stylesheet" href="css/hoverstyle.css" type="text/css" />
<link rel="stylesheet" href="css/product.css" type="text/css" />
<link rel="stylesheet" href="search.css" type="text/css">

<!--Search-->
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
function fill(Value)
{
$('#name').val(Value);
$('#display').hide();
}

$(document).ready(function(){
$("#name").keyup(function() {
var name = $('#name').val();
if(name=="")
{
$("#display").html("");
}
else
{
$.ajax({
type: "POST",
url: "ajax.php",
data: "name="+ name ,
success: function(html){
$("#display").html(html).show();
}
});
}
});
});
</script>-->
<!--END-->
</head>

<body>

<ul class="navigation">
    <li class="active" style="float:left"><a href="index.php">Home</a></li>
    
    <li><a href="" title="Portfolio">Categories</a>
      <ul>
        <li><?php echo "<a  href=\"categories.php?id=1\">Desktop & Laptop</a>"?></li>
        <li><?php echo "<a  href=\"categories.php?id=2\">Mobile & Tab</a>"?></li>
        <li> <?php echo "<a  href=\"categories.php?id=3\">Accessories</a>"?></li>
      </ul>
    </li>
    <li style="float:right"><a href="login.php">Sign IN</a></li>
    <li style="float:right"><a href="" title="About us">About</a></li>
    <li style="float:right"><a href="" title="Contact">Contact</a></li>
    <div class="clear"></div>
</ul>


<!--search er kaj add krte hbe-->  



<!---->


<div>
<div>
<img src="images/e-commerce-banner.jpg" width="1349" height="382" alt="image" >
</div>

<marquee class='ban'>
<?php 
include('DBconn.php');
$sql="SELECT `news` FROM `headliner`";
$result = $conn->query($sql);
while($row = $result->fetch_assoc())
{
	echo $title=$row['news'];
}

?>
</marquee>
<div class="body"  >
<!--------------- 	1st Panel 	--------------->
<div class="container prod">
	<H3>DESKTOP | LAPTOP</H3>
    <div class="row">

<?php 
$select = "SELECT * FROM `product` WHERE `category_id` = '1' ORDER BY ID DESC LIMIT 5";
$result=$conn->query($select);
while($row = $result->fetch_assoc()){  
?>
    	
        <div class="col-20" align="center" >
       		<form action="#" method="post" name="myform">			
                <img src="product_image/<?php echo $row['image'] ?>" alt="image" height="50%" width="50%"  >
                <a <?php echo" href='view_details.php?id=$row[product_id]' "?> target="_blank" class="p pp">
                <h4 style="color:#069"><?php echo $row['title'] ?></h4>
                <p><?php echo $row['desp'] ?></p>
                <p style="color:#3e2723"><b><?php echo "TK. ".$row['price'] ?></b></p>
                </a>
                <div>
                <input type="submit" name="add_to_cart" value="Add to Cart">
                <input type="submit" name="buy" value="Buy">
                </div><br>
			</form>               
                          			
        </div>
        
<?php }?>
       
    </div>
</div>



<!--------------- 	2nd Panel 	--------------->

<div class="container prod">
	<H3>SMART PHONE | TAB</H3>
    <div class="row">

<?php 
$select = "SELECT * FROM `product` WHERE `category_id` = '2' ORDER BY ID DESC LIMIT 5";
$result=$conn->query($select);
while($row = $result->fetch_assoc()){  
?>
    	
        <div class="col-20" align="center">
       					
       		<form action="#" method="post" name="myform">			
                <img src="product_image/<?php echo $row['image'] ?>" alt="image" height="50%" width="50%"  >
                <a <?php echo" href='view_details.php?id=$row[product_id]' "?>target="_blank" class="p pp">
                <h4 style="color:#069"><?php echo $row['title'] ?></h4>
                <p><?php echo $row['desp'] ?></p>
                <p style="color:#3e2723"><b><?php echo "TK. ".$row['price'] ?></b></p>
                </a>
                <div>
                <input type="submit" name="add_to_cart" value="Add to Cart">
                <input type="submit" name="buy" value="Buy">
                </div><br>
			</form>
                    			
        </div>
        
<?php }?>
       
    </div>
</div>


<!--------------- 	3rd Panel 	--------------->


<div class="container prod">
	<H3>ACCESSORIES</H3>
    <div class="row">

<?php 
$select = "SELECT * FROM `product` WHERE `category_id` = '3' ORDER BY ID DESC LIMIT 5";
$result=$conn->query($select);
while($row = $result->fetch_assoc()){  
?>
    	
        <div class="col-20" align="center">
       					
       		<form action="#" method="post" name="myform">			
                <img src="product_image/<?php echo $row['image'] ?>" alt="image" height="50%" width="50%" >
                <a <?php echo" href='view_details.php?id=$row[product_id]' "?> target="_blank" class="p pp">
                <h4 style="color:#069"><?php echo $row['title'] ?></h4>
                <p><?php echo $row['desp'] ?></p>
                <p style="color:#3e2723"><b><?php echo "TK. ".$row['price'] ?></b></p>
                </a>
                <div>
                <input type="submit" name="add_to_cart" value="Add to Cart">
                <input type="submit" name="buy" value="Buy">
                </div><br>
			</form>
                    			
        </div>
        
<?php }?>
       
    </div>
</div>



<!------------   END  ------------->
</div>
</div>

<div>
<footer style="background-color:#757575">
<br><center>
<img src="images/mlogo.png" height="50px" width="200px">
<img src="images/footer.png" height="50px" width="100px">
Copyright (c) 2016 All Rights Reserved
</center>
</footer>
</div>

</body>
</html>

