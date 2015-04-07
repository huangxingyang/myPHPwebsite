<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(test_input($_POST["submit"])=="Add Contact"){
session_start();
require('getDB.php');

   // echo "a";
    $stmt = $conn->prepare("INSERT INTO contacts(userName,contactName,comments,dateAdded)VALUES(?,?,?,?)");
    // echo "b";
    $stmt->bindValue(1, test_input($_SESSION["userName"]), PDO::PARAM_STR);
    // echo $_SESSION["userName"];
    $stmt->bindValue(2, test_input($_POST["toUser"]), PDO::PARAM_STR);
     //echo $_POST["toUser"];
    $stmt->bindValue(3, test_input($_POST["Comment"]) , PDO::PARAM_STR);
     //echo $_POST["Comment"];
    $stmt->bindValue(4, test_input(date("Y-m-d H:i:s")), PDO::PARAM_STR);
    // echo date("Y-m-d H:i:s");
    $stmt->execute();
    // echo "g";
   // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo count($rows);
    // if(count($rows)==1){


    echo "<script type='text/javascript'>window.location.href = \"04_success.php\";</script>";
    // }else{

    //  echo "<script type='text/javascript'>window.location.href = \"07_addContactForm.php?toUser=".$_POST["toUser"]."\";</script>";	
    // }


}else if(test_input($_POST["submit"])=="Clear Form"){

 echo "<script type='text/javascript'>window.location.href = \"07_addContactForm.php?toUser=".$_POST["toUser"]."\";</script>";


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



<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<p class="lead">Add Contact Form</p>
<table class="table table-striped">
<tbody>
<tr><td width="100px">Contact to be added</td><td width="500px"><?php echo $_GET["toUser"];?><input type="hidden" name="toUser" value= <?php echo $_GET["toUser"];?>></td></tr>
<tr><td width="100px" height="100px">Comments:</td><td><textarea name="Comment" class="form-control" rows="3"></textarea></td></tr>
<tr><td><input name="submit" type="submit" class="btn btn-primary" value="Add Contact"></td><td><input name="submit" class="btn btn-primary" type="submit" value="Clear Form"></td></tr>
</tbody>
</table>


</form>
</div>  
</body>  
</html> 