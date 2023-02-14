<?php
session_start();
$bill_no = $_POST['bill-no'];
$bill_name = $_POST['bill-name'];
$label_id = $_POST['label_id'];
$_SESSION['bill_name'] = $bill_name;
$_SESSION['bill_no'] = $bill_no;
$_SESSION['label_id'] = $label_id;
echo "<script>window.location.href = 'saving-bill.php';</script>";
?>