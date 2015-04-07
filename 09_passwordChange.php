<?php 
session_start();

//
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 // echo "b";
  //echo test_input($_POST["submit"]);
if(test_input($_POST["submit"])=="ChangePassword"){

 //   echo "aaaa";
if($_POST["oldPassword"]==$_SESSION["userPassword"]){
if($_POST["newPassword"]==$_POST["newRePassword"]){


require('getDB.php');
    $stmt = $conn->prepare("update userstable set UserPassword=? WHERE UserID=?");
    $stmt->bindValue(1, $_POST["newRePassword"] , PDO::PARAM_STR);
    $stmt->bindValue(2, $_SESSION["userID"] , PDO::PARAM_INT);
   // echo "aaaaa".$_SESSION["userName"];
    $stmt->execute();
    $_SESSION["userPassword"]=$_POST["newRePassword"];
    echo "<script type='text/javascript'>window.location.href = \"04_success.php\";</script>";

  
}else{
// echo "x";
$newPasswordErr="new password not mach!";
$newRePasswordErr="new password not mach!";


 }



}else{
    // echo "a".$_SESSION["userPassword"];
    $oldPasswordErr="your password is incorrect!";

}



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
<p class="lead">Password Change Form</p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table class="table table-striped">
<tbody>

<tr><td>Please Enter Your Old Password: </td><td><input name="oldPassword" type="password" ><?php echo $oldPasswordErr?></td></tr>
<tr><td>Please Enter Your New Password: </td><td><input name="newPassword" type="password" ><?php echo $newPasswordErr?></td></tr>
<tr><td>Please Enter Your New Password Again: </td><td><input name="newRePassword" type="password" ><?php echo $newRePasswordErr?></td></tr>
<tr><td rowspan="2"><input name=submit type="submit" value="ChangePassword" class="btn btn-primary"></td></tr>
</tbody>
</table>



</form>
</div>  
</body>  
</html> 