<?php
session_start();
$bill_no = $_SESSION['bill_no'];
$bill_name = $_SESSION['bill_name'];
$item_no = $_POST['item_no'];
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
$sql = "DELETE FROM $bill_name where item_no = '$item_no' ";
if ($conn->query($sql)) 
{
  $sql = "SELECT * FROM $bill_name";
  $result = $conn->query($sql);
  $curr = $item_no;
  while($row = $result->fetch_assoc())
  {
    $to_item = $curr;
    $curr = $to_item + 1;
    $sql = "UPDATE $bill_name SET item_no = '$to_item' where item_no = '$curr'";
    if ($conn->query($sql)) 
    {
      continue;
    }
    else
    {
      break;
    }
  }
  echo "<script>window.location.href = 'saving-bill.php';</script>";
} 
else 
{
  echo "Error saving item into table ". $bill_name. " : " . $conn->error;
}
?>