<?php 
session_start();
require('getDB.php');

if("one"==$_GET["way"]){
$uid=$_GET["uid"];
//echo $uid;

    $stmt = $conn->prepare("SELECT * FROM userstable WHERE UserID=?");
    $stmt->bindValue(1, $uid, PDO::PARAM_INT);
   // echo "aaaaa".$_SESSION["userName"];
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($rows); 
}else if("two"==$_GET["way"]){
$uName=$_GET["uName"];
//echo $uName;
    $stmt = $conn->prepare("SELECT * FROM userstable WHERE UserName=?");
    $stmt->bindValue(1, $uName, PDO::PARAM_STR);
   // echo "aaaaa".$_SESSION["userName"];
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

//var_dump($rows); 

}else if("three"==$_GET["way"]){
$showMe=$_GET["showMe"];
$seekingA=$_GET["seekingA"];
$age=$_GET["age"];
$to=$_GET["to"];
$country=$_GET["country"];
$state=$_GET["state"];
$city=$_GET["city"];

    $stmt = $conn->prepare("SELECT * FROM userstable WHERE Gender=? and SeekingGender=? and Country=? and State=? and City=? and age between ? and ?");
    $stmt->bindValue(1, $showMe, PDO::PARAM_INT);
    $stmt->bindValue(2, $seekingA, PDO::PARAM_INT);
    $stmt->bindValue(3, $country, PDO::PARAM_INT);
    $stmt->bindValue(4, $state, PDO::PARAM_INT);
    $stmt->bindValue(5, $city, PDO::PARAM_INT);
    $stmt->bindValue(6, $age, PDO::PARAM_INT);
    $stmt->bindValue(7, $to, PDO::PARAM_INT);
   // echo "aaaaa".$_SESSION["userName"];
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


//var_dump($rows); 
//echo "three";
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
<p class="lead">Search Result</p>

<table class="table table-striped">

<thead>
<tr><td>UserName</td><td>Gender</td><td>City/State</td><td>Country</td><td>About User</td><td>Add to Contact</td></tr>
</thead>
<tbody>

<?php
 foreach ($rows as $row) {

 
 echo "<tr><td>".$row["UserName"]."</td><td>".$row["Gender"]."</td><td>".$row["City"]."/".$row["State"]."</td><td>".$row["Country"]."</td><td>".$row["AboutMe1"]."</td><td><a href=\"07_addContactForm.php?toUser=".$row["UserName"]."\">add</a></td></tr>";

 }

?>
<!-- <c:forEach items ="${userList}" var="user">
<tr><td>${user.userName}</td><td>${user.gender} </td><td>${user.city}/${user.state }</td><td>${user.country }</td><td>${user.aboutMe1 }</td><td><a href="addContactPage?toUser=${user.userName}">add</a></td></tr>


</c:forEach> -->
</tbody>
</table>


</div>  
</body>  
</html> 