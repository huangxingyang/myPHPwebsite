    
<?php
session_start();
 require('getDB.php');
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	

if(test_input($_POST["submit"])=="Send Message"){

   

    $stmt = $conn->prepare("INSERT INTO messages(userName,fromUser,message,messageDate)VALUES(?,?,?,?)");
    $stmt->bindValue(1, test_input($_POST["toUser"]), PDO::PARAM_STR);
    $stmt->bindValue(2, test_input($_SESSION["userName"]), PDO::PARAM_STR);
    $stmt->bindValue(3, test_input($_POST["message"]) , PDO::PARAM_STR);
    $stmt->bindValue(4, test_input(date("Y-m-d H:i:s")), PDO::PARAM_STR);

    $stmt->execute();


    echo "<script type='text/javascript'>window.location.href = \"04_success.php\";</script>";
    
     



}else if(test_input($_POST["submit"])=="Clear Form"){

 echo "<script type='text/javascript'>window.location.href = \"03_sendMessagePage.php\";</script>";

}
else if(test_input($_POST["submit"])=="Logout"){
    session_unset(); 
    session_destroy(); 
    unset($_COOKIE['username']);
    unset($_COOKIE['userpassword']);
    setcookie('username', null, -1, '/');
    setcookie('userpassword', null, -1, '/');

    echo "<script type='text/javascript'>window.location.href = \"01_loginPage.php?value=logout\";</script>";


}





}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>



<html>  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<title>Untitled Document</title>  
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>  
<style type="text/css">  
#left{  
    float:left; width:240px; height:500px; 
}  

#center{  
    height:500px;  
}  
</style>  
<body>  
<div class="col-xs-3">
<ul class="nav nav-pills nav-stacked">
<br/>
<br/>
  <li role="presentation"><a href="05_Search.php">Search</a></li>
  <li role="presentation"><a href="02_messagePage.php">Show Messages</a></li>
  <li role="presentation"><a href="08_contactList.php">View My Contacts</a></li>
  <li role="presentation"><a href="09_passwordChange.php">Change Password</a></li>
</ul>

<p>
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input name="submit" value="Logout" type="submit" class="btn btn-primary">
</form>
</p>

</div>  
<div class="col-xs-9">


<h1>Send Message Form</h1>
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table class="table table-striped">
<tbody>
<tr><td width="100px">From:</td><td width="600px"><?php echo $_SESSION["userName"] ?></td></tr>
<tr><td width="100px" >To:</td><td width="600px"><?php echo $_GET["toUser"] ?><input type="hidden" name="toUser" value=<?php echo $_GET["toUser"]?>></td></tr>
<tr><td width="100px" height="100px">Message:</td><td width="600px" height="100px"><textarea name="message" rows="10" cols="85" ></textarea></td></tr>
<tr><td><input name="submit" type="submit" value="Send Message" class="btn btn-primary"></td><td><input name="submit" type="submit" value="Clear Form" class="btn btn-primary"></td></tr>
</tbody>
</table>



</form>
</div>  
</body>  
</html> 