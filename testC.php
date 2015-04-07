<?php

$value = "yusuf";
$val="password";


echo $_COOKIE["username"]."====";
echo $_COOKIE["userpassword"]."====";

//echo "<script> alert(); </script> ";
echo $_COOKIE["userName"]."====";
echo $_COOKIE["userPassword"]."====";
 setcookie("Name", $value, time()+3600);
 setcookie("Password",$val, time()+3600);  /* expire in 1 hour */

?>


<?php

echo $_COOKIE["Name"]."====";
echo $_COOKIE["Password"]."====";
?>


