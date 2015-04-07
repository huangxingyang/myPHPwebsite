
<?php
$strErr1=$strErr2=$strErr3=$strErr4=$strErr5=$strErr6="";
session_start();
require('getDB.php');
    $stmt = $conn->prepare("SELECT * FROM countries");

   // echo "aaaaa".$_SESSION["userName"];
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
if("See Profile by ID"==$_POST["submit"]){
$string=test_input($_POST["memberNumber"]);
if(ctype_digit($string)){
 echo $string;
 
 echo "<script type='text/javascript'>window.location.href = \"06_searchResult.php?way=one&uid=" . $string . "\";</script>";

}else{

$strErr1="Format Error!";

}

}else if("See Profile by Name"==$_POST["submit"]){

$string=test_input($_POST["userName"]);
if(ctype_alpha($string)){

 echo "<script type='text/javascript'>window.location.href =  '06_searchResult.php?way=two&uName=".$string."';</script>";

}else{
$strErr2="Format Error!";

}
}

else if("Quick Search"==$_POST["submit"]){
$stringAge=test_input($_POST["age"]);

$stringTo=test_input($_POST["to"]);

$stringState=test_input($_POST["state"]);

$stringCity=test_input($_POST["city"]);





if((ctype_digit($stringAge))&&(ctype_digit($stringTo))&&(ctype_alpha($stringState))&&(ctype_alpha($stringCity))){

 echo "<script type='text/javascript'>window.location.href = ' 06_searchResult.php?way=three&showMe=".$_POST["showMe"]."&seekingA=".$_POST["seekingA"]."&age=".$stringAge."&to=".$stringTo."&country=".$_POST["country"]."&state=".$stringState."&city=".$stringCity."';</script>";
// 
// 
}else{

$stringAge=test_input($_POST["age"]);
if(ctype_digit($stringAge)){


}else{

$strErr3="Format Error!"; 
}

if(ctype_digit($stringTo)){



}else{
$strErr4="Format Error!";

}

if(ctype_alpha($stringState)){



}else{

$strErr5="Format Error!";  
}

if(ctype_alpha($stringCity)){



}else{
$strErr6="Format Error!";

}



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
<p class="lead">Look up by Member Number</p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table class="table table-striped">
<tbody>
<tr><td>Please enter the member number of the person you want to look up.</td></tr>
<tr><td><input name="memberNumber" type="text"/><?php echo $strErr1?><input name="submit" type="submit" value="See Profile by ID"  class="btn btn-primary"></td></tr>
</tbody>
</table>


<p class="lead">Look up by Username</p>

<table class="table table-striped">
<tbody>
<tr><td>Please enter the Username of the person you want to look up.</td></tr>
<tr><td><input name="userName" type="text"/><?php echo $strErr2?><input name="submit" type="submit" value="See Profile by Name"  class="btn btn-primary"></td></tr>
</tbody>
</table>


<p class="lead">Quick Search</p>

<table class="table table-striped">
<tbody>
<tr><td class="col-xs-3">Show me:
<select name="showMe">
  <option value ="female">Female</option>
  <option value ="male">Male</option>
</select>

</td>
<td class="col-xs-3">
Seeking a:
<select name="seekingA">
  <option value ="female">Female</option>
  <option value ="male">Male</option>
</select>
</td></tr>
<tr><td class="col-xs-3">Age:<input name="age" type="text"> <?php echo $strErr3?> </td><td>To: <input name="to" type="text"> <?php echo $strErr4?></td></tr>
<tr>
<td class="col-xs-3">Search Location:</td>
<td >

country:<select name="country">
<?php
 foreach ($rows as $row) {

 
 echo "<option value =".$row["countryName"].">".$row["countryName"]."</option>";

 }

?>
<!-- 
<c:forEach items ="${countryList}" var="country">
  <option value =${ country.countryName} >${country.countryName}</option>
</foreach>
</c:forEach> -->
</select>
<br/>
<br/>
<div>State:<input name="state" type="text"><?php echo $strErr5?></div>
<br/>
<div>city:<input name="city" type="text"><?php echo $strErr6?></div>

</td>
</tr>
<tr>


</tr>

<tr><td  colspan="2"  class="col-xs-3"><input name="submit" type="submit" value="Quick Search"  class="btn btn-primary"></td></tr>
</tbody>
</table>
</form>

</div> 
 
</body>  
</html> 