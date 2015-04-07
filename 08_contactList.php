
<?php 
session_start();
require('getDB.php');
    $stmt = $conn->prepare("SELECT * FROM contacts WHERE contactName=?");
    $stmt->bindValue(1, $_SESSION["userName"] , PDO::PARAM_STR);
   // echo "aaaaa".$_SESSION["userName"];
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 // echo "b";
  //echo test_input($_POST["submit"];
if(test_input($_POST["submit"])=="Delete Selected Context"){

   // echo "aaaa";
    foreach($_POST['delete'] as $selected){


    $stmt = $conn->prepare("DELETE FROM contacts WHERE contactID=?");

    $stmt->bindValue(1, $selected , PDO::PARAM_INT);
   // echo $selected ;
    $stmt->execute();
   // echo "success!";

    }


    $stmt = $conn->prepare("SELECT * FROM contacts WHERE contactName=?");
    $stmt->bindValue(1, $_SESSION["userName"] , PDO::PARAM_STR);
   // echo "aaaaa".$_SESSION["userName"];
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);



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
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<p class="lead">Welcome! <?php echo $_SESSION["userName"] ?></p>

<table class="table table-striped">
<thead>
<tr><td>Contact ID</td><td>Contact Name</td><td>Comment</td><td>Date</td><td>Delete</td></tr>
</thead>
<tbody>
 <?php
 foreach ($rows as $row) {

 
 echo "<tr><td>".$row["contactID"]."</td><td>".$row["userName"]."</td><td>".$row["comments"]."</td><td>".$row["dateAdded"]."</td><td><input name='delete[]' type=\"checkbox\" value='".$row["contactID"]."'/>Delete</td></tr>";

 }

?>


<!-- <c:forEach items ="${contactList}" var="contact">

<tr><td>${contact.contactID}</td><td>${contact.userName}</td><td>${contact.comments}</td><td>${contact.dateAdded}</td><td><input name="delete" type="checkbox" value=${contact.contactID }>delete</td></tr>

</c:forEach> -->
<tr><td rowspan="5"><input name="submit" type="submit" value="Delete Selected Context" class="btn btn-primary"></td></tr>
</tbody>
</table>


</form>
</div>  
</body>  
</html> 