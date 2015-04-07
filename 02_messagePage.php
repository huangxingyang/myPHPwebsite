
    
<?php

session_start();
 require('getDB.php');


?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	

if(test_input($_POST["submit"])=="delete"){

   

    foreach($_POST['delete'] as $selected){


    $stmt = $conn->prepare("DELETE FROM messages WHERE messageID=?");
    $stmt->bindValue(1, $selected , PDO::PARAM_INT);

    $stmt->execute();

    }
     
    // foreach ( $_POST['delete'] as $deleteVal) {
    // echo "aaaaa";
    // echo $deleteVal;
    // 	# code...
    // // $stmt = $conn->prepare("DELETE FROM messages WHERE messageID=?");
    // // $stmt->bindValue(1, $row[0] , PDO::PARAM_INT);
    // // echo "aaaaa".$row[0];
    // // $stmt->execute();
    // }

   //$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);



}

if(test_input($_POST["submit"])=="Logout"){
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
    float:left; width:240px; height:1000px; 
}  

#center{  
    height:1000px;  
}  
</style>  
<body>  

<?php 

//require('getDB.php');

    $stmt = $conn->prepare("SELECT * FROM messages WHERE userName=?");
    $stmt->bindValue(1, $_SESSION["userName"] , PDO::PARAM_STR);
   // echo "aaaaa".$_SESSION["userName"];
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  //  var_dump($rows);

?> 



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
<p class="lead">Welcome! <?php echo $_SESSION["userName"] ?></p>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table class="table  table-striped">
<thead>
<tr><td>Message ID</td><td>From User</td><td>Message</td><td>Date</td><td>Reply to User</td><td>Delete</td></tr>
</thead>
<tbody>


<?php
 foreach ($rows as $row) {

 
 echo "<tr><td>". $row["messageID"]." </td><td>".$row["fromUser"]."</td><td>".$row["message"]."</td><td>".$row["messageDate"]."</td><td><a href=\"03_sendMessagePage.php?toUser=".$row["fromUser"]."\">Reply</a></td><td><input name='delete[]' type=\"checkbox\" value=".$row["messageID"]."/>Delete</td></tr>";

 }



?>
<tr><td colspan="6">you have <?php echo count($rows)?> messages</td></tr> 
<tr><td colspan="6"><input name="submit" type="submit" value="delete" class="btn btn-primary"></td></tr>
</tbody>
</table>

</form> 
</div>

  
</body>  
</html> 