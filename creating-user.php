<?php
session_start();
$uname = $_POST['uname'];
$uemail = $_POST['uemail'];
$passkey = $_POST['passkey'];
$cpasskey = $_POST['cpasskey'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$user_type = $_POST['user-type'];

echo $uname."<br>";
echo $uemail."<br>";
echo $passkey."<br>";
echo $cpasskey."<br>";
echo $phone."<br>";
echo $address."<br>";
echo $user_type."<br>";

$created_on = date('d-m-y');
$created_on_time = date('h:i:s');
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

$pattern = '/^(?=.*[!@#%&*])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{8,14}$/';
if(preg_match($pattern, $passkey))
{
   if ($passkey == $cpasskey) 
   {
   		$sql = "INSERT INTO WebBiller_user (uname, uemail, passkey, phone, address, user_type, created_on, created_on_time) VALUES ( '$uname' , '$uemail', '$passkey', '$phone', '$address', '$user_type', '$created_on', '$created_on_time')";
   	if ($conn->query($sql)) 
   	{
   		echo "Saved Sucessfully";
   	}
   	else
   	{
   		echo "<br>Not Saved".$conn->error;
   	}
   }
   else
   {
   		echo "<script>alert('Your passswords does not match');</script>";
   }
} 
else 
{
   echo "<script>alert('Your passsword should contain minimum of one number, one uppercase, one lowercase, one of ! @ # % & * and must be between 8 and 14 characters in length ');</script>";
}
?>