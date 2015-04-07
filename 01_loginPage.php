
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>login page</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<style>
.error {color: #FF0000;}
</style>




</head>

<body>
<?php
//echo $_GET["value"]."aa";

if("logout"==$_GET["value"]){

    unset($_COOKIE['username']);
    unset($_COOKIE['userpassword']);
    setcookie('username', null, -1, '/');
    setcookie('userpassword', null, -1, '/');
}

$un=$_COOKIE["username"]; 
echo $un."a";
$up=$_COOKIE["userpassword"];
echo $up."b";

if((""!=$un)&&(""!=$up)){
require('getDB.php');
     $stmt = $conn->prepare("SELECT * FROM userstable WHERE UserName=? AND  UserPassword=?");
     $stmt->bindValue(1, $un, PDO::PARAM_STR);
     $stmt->bindValue(2, $up, PDO::PARAM_STR);
     $stmt->execute();
     $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

     
    var_dump($rows);
    
    if (count($rows)==1) {
    session_start();
     $_SESSION["userID"] = $rows[0]["UserID"];
     $_SESSION["userName"] = $un;
     $_SESSION["userPassword"] = $up;
    // echo "<script> alert(); </script> ";  
    echo "<script type='text/javascript'>window.location.href = \"02_messagePage.php\";</script>";

    }


}


?>
<?php
// define variables and set to empty values

$nameErr = $pwdErr = "";
$userName = $userPassword = "";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

   if (empty($_POST["userName"])) {
     $nameErr = "Name is required";
   } else {
     $userName = test_input($_POST["userName"]);
   }
   
   if (empty($_POST["userPassword"])) {
     $pwdErr = "Password is required";
   } else {
     $userPassword = test_input($_POST["userPassword"]);
   }

   if((""!=$userName)&&(""!=$userPassword))
	{
    require('getDB.php');
// $servername = "localhost";
// $ausername = "xingyang";
// $apassword = "password";
// $conn = new PDO("mysql:host=$servername;dbname=contacts", $ausername, $apassword);
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 try {

   // $stmt= $conn->prepare("SELECT * FROM userstable WHERE UserName=:username AND UserPassword=:userPassword");
     $stmt = $conn->prepare("SELECT * FROM userstable WHERE UserName=? AND  UserPassword=?");
     $stmt->bindValue(1, $userName, PDO::PARAM_STR);
     $stmt->bindValue(2, $userPassword, PDO::PARAM_STR);
     $stmt->execute();
     $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

     
//     // var_dump($rows);
    
    if (count($rows)==1) {
//    	  //sendredirect
    session_start();
    if("rememberMe"==$_POST["rememberMe"]) {
       // unset($_COOKIE["userName"]);
       // unset($_COOKIE["userPassword"]);
    // $cookie_name = "userName";
     //$cookie_value = $userName;;
  
     // echo "rememberMe";
     // setcookie("userName", $userName, time() + (86400 * 30), "/"); // 86400 = 1 day
     // echo $_COOKIE['userName']."username";
     // setcookie("userPassword", $userPassword, time() + (86400 * 30), "/");
     // echo $_COOKIE["userPassword"]."password";

 //  setcookie("userName", $userName);
   require("testC.php");


   // setcookie("userName", $value, time()+3600);  /* expire in 1 hour */
//   echo "<script> alert(); </script> ";  
   // setcookie("userPassword",$userPassword,time()+3600);
 //  echo "<script type='text/javascript'>window.location.href = \"01_loginPage.php\";</script>";
  // echo "here".$userName;
 //  setcookie("userName", $userName, time()+3600, "/~rasmus/", "example.com", 1);
     }
     

     $_SESSION["userID"] = $rows[0]["UserID"];
     $_SESSION["userName"] = $userName;
     $_SESSION["userPassword"] = $userPassword;
//      // echo "Session variables are set.";


//      // echo "my user id is".$_SESSION["userID"] . ".<br>";
//      // echo "my user name is " . $_SESSION["userName"] . ".<br>";
//      // echo "my user password is " . $_SESSION["userPassword"] . ".";
 echo "<script type='text/javascript'>window.location.href = \"02_messagePage.php\";</script>";





    }else{
// //      $nameErr = "your account is incorrect!";


    }


}
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }



}
}





function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<div class="container">
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table class="table table-striped" >
    <tbody>
    <tr><td>UserName:</td><td> <input type="text" name="userName" /></td>
                      <td class="error">* <?php echo $nameErr;?></td>

<td rowspan="3"><input  name="login" type="submit" class="btn btn-primary"/></td></tr>
<tr><td>Password:</td><td> <input type="password" name="userPassword" /> </td>
                      <td class="error"> * <?php echo $pwdErr;?></td>
</tr>
<tr><td colspan="3"><input name="rememberMe" type="checkbox" value="rememberMe" />Remember me for one week</td></tr>
</tbody>
</table>
</form>
</div>

</body>
</html>