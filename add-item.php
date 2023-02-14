<?php
session_start();
$bill_no = $_SESSION['bill_no'];
$bill_name = $_SESSION['bill_name'];
$item_no = $_POST['item_no'];
$item_name = $_POST['item_name'];
$quantity = $_POST['quantity'];
$price = $_POST['item_price'];
$discount = $_POST['discount'];
$amount = $_POST['ammount'];
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
$sql = "INSERT INTO $bill_name (item_no, item_name, quantity, price, discount, amount) VALUES ('$item_no' , '$item_name' , '$quantity' , '$price' , '$discount' , '$amount')";
if ($conn->query($sql)) 
{
  echo "<script>window.location.href = 'saving-bill.php';</script>";
} 
else 
{
  echo "Error saving item into table ". $bill_name. " : " . $conn->error;
}
?>