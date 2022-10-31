<?php
include('../_inc/inc.php');
include('../_inc/db.php');

include('./password.php');

$hashed = password_hash('admin12!', PASSWORD_DEFAULT);
$sql = "UPDATE ESG_MEMBER SET MEMBER_PW = '$hashed' WHERE MEMBER_ID = 'admin'";
$result = mysqli_query($dbconn,$sql);

echo $result;
?>
