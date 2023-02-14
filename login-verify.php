<?php
session_start();
$uemail = $_POST['uemail'];
$passkey = $_POST['passkey'];
$servername="sql544.main-hosting.eu";
$username="u745359346_GST";
$password="GST_dev@CCT2022";
$conn=mysqli_connect($servername,$username,$password);
if(!$conn)
{
  die("Connection failed:".mysqli_connect_error());
}
//   echo "connected successfully";
//   echo "<br>";
$dbname="u745359346_GST";
mysqli_select_db($conn,$dbname);
$sql = "SELECT * FROM WebBiller_user where uemail = '$uemail";
if ($result = $conn->query($sql);) 
{
	$row = $result->fetch_assoc();
	if($row['passkey'] == '$passkey')
	{
		
	}
}
?>