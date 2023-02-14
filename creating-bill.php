<?php
date_default_timezone_set('Asia/Kolkata');
$bill_no = 0;
$billed_to = $_POST['billed-to'];
$billed_by = $_POST['billed-by'];
$label_id= $_POST['bill-label'];
$billed_to_contact = $_POST['billed-to-contact'];
$billed_on = date('d-m-y');
$billed_on_time = date('h:i:s');
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
$sql = "SELECT * FROM WebBiller";
$result = $conn->query($sql);
$rowcount = mysqli_num_rows( $result );
$bill_no = $rowcount + 1;
$new_bill_name = "bill".$bill_no;
echo $new_bill_name;
$sql = "CREATE TABLE $new_bill_name ( item_no VARCHAR (10), item_name VARCHAR(100), quantity VARCHAR(10), price VARCHAR(10), discount VARCHAR(10), amount VARCHAR(10))";
if ($conn->query($sql)) 
{
  echo "Bill ".$new_bill_name." Created Sucessfully";
} 
else 
{
  echo "Error creating table: " . $conn->error;
}
$sql = "INSERT INTO WebBiller (bill_no, billed_to, billed_to_contact, billed_by, no_of_items, total, status, paid_via, billed_on, paid_on, billed_on_time, paid_on_time, label_id) VALUES ( '$bill_no' , '$billed_to', '$billed_to_contact', '$billed_by', '0', '0', 'N', 'N', '$billed_on', '00-00-0000', '$billed_on_time', '00-00-00', '$label_id' )";
if ($conn->query($sql)) 
{
  echo "Bill ".$new_bill_name." draft saved Sucessfully";
  session_start();
  $_SESSION['label_id'] = $label_id;
  $_SESSION['bill_no'] = $bill_no;
  $_SESSION['bill_name'] = $new_bill_name;
  $_SESSION['billed_to'] = $billed_to;
  $_SESSION['billed_to_contact'] = $billed_to_contact;
  $_SESSION['billed_by'] = $billed_by;
  echo "<script>window.location.href = 'saving-bill.php';</script>";
} 
else 
{
  echo "Error saving draft table: " . $conn->error;
}
$conn->close();
?>