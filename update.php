<?php
$bill_no = $_POST['bill-no'];
$status = $_POST['status'];
echo $bill_no;
echo $status;
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
$sql = "UPDATE WebBiller SET status='$status' where bill_no='$bill_no'";
if ($conn->query($sql)) 
{
  echo "<script>window.location.href = 'all-bills.php';</script>";
} 
else 
{
  echo "Error saving item into table ". $bill_name. " : " . $conn->error;
}
?>