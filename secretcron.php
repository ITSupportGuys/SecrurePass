<?php
$epoch = time();
$con = mysqli_connect("localhost", "$User", "$Pass", "$DB");
if (mysqli_connect_errno()) {
     die(mysqli_connect_error());
}
$result = mysqli_query($con, "DELETE FROM `itsuppor_passwords`.`passwords` WHERE `CREATED` <= '$epoch' ") or die (mysql_error());
?>