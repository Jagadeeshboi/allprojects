<?php
session_start();
$bill_no = $_SESSION['bill_no'];
$bill_name = $_SESSION['bill_name'];
// $label_id = $_SESSION['label_id'];
// $billed_to = $_POST['billed-to'];
// $billed_by = $_POST['billed-by'];
// $bill_label = $_POST['bill-label'];
date_default_timezone_set('Asia/Kolkata');
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
$sql = "SELECT * FROM $bill_name";
$result = $conn->query($sql);
$no_of_items = 0;
$total = 0;
// echo "Bill name = ".$bill_name."<br>Bill no = ".$bill_no."<br>Label = ".$label_id;
while($row = $result->fetch_assoc())
{
	$total = $total + $row['amount'];
	$no_of_items = $no_of_items + 1;
}
$sql = "UPDATE WebBiller SET total = '$total' where bill_no = '$bill_no' ";
if ($conn->query($sql)) 
{
	// echo "Totaled and saved";
	$sql = "UPDATE WebBiller SET no_of_items = '$no_of_items' where bill_no = '$bill_no' ";
	if ($conn->query($sql)) 
	{
		$sql = "SELECT * FROM WebBiller where bill_no='$bill_no'";
		if ($result = $conn->query($sql)) 
		{
			while($row = $result->fetch_assoc())
			{
				$billed_to = $row['billed_to'];
				$billed_by = $row['billed_by'];
				$billed_to_contact = $row['billed_to_contact'];
				$label_id = $row['label_id'];
				$total = $row['total'];
				$total_paid = $row['total_paid'];
				$paid_via = $row['paid_via'];
				$billed_on = $row['billed_on'];
				$billed_on_time = $row['billed_on_time'];
				$paid_on = $row['paid_on'];
				$paid_on_time = $row['paid_on_time'];
				if ($row['status'] == "N") 
				{
					$status = "Not Paid";
					$update = "Mark as Paid";
				}
				else
				{
					$status = "Paid";
					$update = "As NOT Paid";
					echo "<tr>";
				}
				if($row['paid_via'] == "O")
				{
					$paid_via = "Online";
				}
				else if($row['paid_via'] == "C")
				{
					$paid_via = "Cash";
				}
				else if($row['paid_via'] == "H")
				{
					$paid_via = "Cheque";
				}
				else if($row['paid_via'] == "B")
				{
					$paid_via = "Bank Transfer";
				}
				else
				{
					$paid_via = "NIL";
				}
			}
		}
		else
		{
			echo "Error extracting data from Web Biller table: " . $conn->error;
		}
	}
	else
	{
		echo "Error saving draft table: " . $conn->error;
	}
}
else
{
	echo "Error saving draft table: " . $conn->error;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Calanjiyam Web Biller</title>
	<link rel="icon" type="image/png" href="http://crisscrosstamizh.tech/GST-Dev/assets/img/light_cct.png">
	<link href="style.css" rel="stylesheet" >
	<style>
		.display_td
		{
			border: 2px solid grey;
			padding-left: 15px;
		}
		.itemno
		{

			width : 1%;
			border: 2px solid grey;
			padding: 10px;
			/*border: 1px solid #004AAD;*/
		}
		.td_itemno
		{
			width : 90%;
			/*border: 1px solid #004AAD;*/
		}
		.itemname
		{
			width: 35%;
			border: 2px solid grey;
			/*border: 1px solid #004AAD;*/
		}
		.td_itemname
		{
			width: 98%;
			/*margin-left: -8px;
			
			border: 1px solid #004AAD;*/
		}
		.th_money
		{
			width: 1%;
			border: 2px solid grey;
			/*border: 1px solid #004AAD;*/
		}
		.tr_price
		{
			width: 10%;
			border: 2px solid grey;
			/*border: 1px solid #004AAD;*/
		}
		.td_price
		{
			width: 95%;
			/*border: 1px solid #004AAD;*/
		}
		.td_money
		{
			width: 90%;
			/*border: 1px solid #004AAD;*/
		}
	</style>
</head>
<body onbeforeunload="return myFunction()">
	<span class="left-corner-heading">
		<h1 style="font-weight: 400;">
			<img src="http://crisscrosstamizh.tech/GST-Dev/assets/img/dark_cct.png" class="left-corner-heading-img">Calanjiyam - Web Biller</h1>
	</span>
	<div id="top-menu" class="top-menu">
		<a href="new-bill.php" style="text-decoration: none;" class="side-menu-button-active">
			<i class="bi bi-file-earmark-plus" style="padding: 8px; margin-right: 10px; font-size: 15px;"></i>New Bill
		</a>
		<a href="all-bills.php" style="text-decoration: none;" class="side-menu-button">
			<i class="bi bi-folder" style="padding: 8px; margin-right: 10px; font-size: 15px;"></i>All Bills
		</a>
		<a href="bill-lables.php" style="text-decoration: none;" class="side-menu-button">
			<i class="bi bi-receipt-cutoff" style="padding: 8px; margin-right: 10px; font-size: 15px;"></i>Bill Lables
		</a>
		<a href="profile.php" style="text-decoration: none;" class="side-menu-button">
			<i class="bi bi-person" style="padding: 8px; margin-right: 10px; font-size: 15px;"></i>Profile
		</a>
		<a href="new-user.php" style="text-decoration: none;" class="side-menu-button">
			<i class="bi bi-person-plus" style="padding: 8px; margin-right: 10px; font-size: 15px;"></i>New User
		</a>
		<a href="logout.php" style="text-decoration: none;" class="side-menu-button-logout">
			<i class="bi bi-power" style="padding: 8px; margin-right: 10px; font-size: 15px;"></i>Logout
		</a>
	</div>
	<div id="new-bill-area" class="new-bill-area">
		<?php
		$sql = "SELECT * FROM bill_label where label_id='$label_id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		?>
		<table id="biller_details" style="width: 100%" class="biller_details">
			<tr>
				<td style="padding-top: 10px;	padding-bottom: 10px;"><img src="<?php echo $row['img_url']; ?>" style="width: 100px;"></td> 
				<td style="padding-top: 10px;	padding-bottom: 10px;">
					<h1 id="company_name" style="font-weight: 450; font-size: 24px; color : red;"><?php echo $row['company_name']; ?></h1>
					<p id="company_address"><?php echo $row['company_address']; ?></p>
					<p id="company_contact"><?php echo $row['company_contact']; ?></p>
				</td>
				<td style="color: #004A98;padding-top: 10px;	padding-bottom: 10px;">
					<p>INVOICE NO</p>
					<p style="font-size: 32px;"><?php echo $bill_no; ?></p>
				</td>
			</tr>
		</table>
		<p style="text-align: center; font-size: 20px; text-shadow: 1px 1px 3px grey;">INVOICE</p>
		<table>
			<tr>
				<td style="padding-left: 10px;"><p>Billing To</p></td>
				<td style="padding-left: 10px;"><p><?php echo $billed_to?></p></td>
			</tr>
			<tr>
				<td style="padding-left: 10px;"><p>Billing To Contact</p></td>
				<td style="padding-left: 10px;"><p><?php echo $billed_to_contact?></p></td>
			</tr>
			<tr>
				<td style="padding-left: 10px;"><p>Billing By</p></td>
				<td style="padding-left: 10px;"><p><?php echo $billed_by ?></p></td>
			</tr>
			<tr>
				<td style="padding-left: 10px;"><p>Total amount to be paid (₹)</p></td>
				<td style="padding-left: 10px;"><p><?php echo  "₹ ".$total."/-"; ?></p></td>
			</tr>
		</table>
		<table id="bill-creation-table" class="bill-creation-table">
			<tr style="text-align: center;">
				<th class="itemno" style="text-align: center;">Item No</th>
				<th class="itemname" style="text-align: center;">Item Name</th>
				<th class="th_money" style="text-align: center;">Quantity</th>
				<th class="tr_price" style="text-align: center;">Price(₹)</th>
				<th class="th_money" style="text-align: center;">Discount(%)</th>
				<th class="th_money" style="text-align: center;">Ammount(₹)</th>
				<th class="th_money" id="th_action" style="text-align: center;">Action</th>
			</tr>
			<?php
			$sql = "SELECT * FROM $bill_name";
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()) 
			{
				echo "<tr><td class='display_td'>".$row['item_no']."</td><td class='display_td'>".$row['item_name']."</td><td class='display_td'>".$row['quantity']."</td><td class='display_td'>".$row['price']."</td><td class='display_td'>".$row['discount']."</td><td class='display_td'>".$row['amount']."</td>";
				echo "<td class='display_td'><form action='remove-item.php' method='POST'><input type='hidden' name='item_no' value='".$row['item_no']."'><input type='submit' value='Remove' class='submit-button'></form></td></tr>";
			}
			$rowcount = mysqli_num_rows( $result );
			$item_no = $rowcount + 1;

			?>
			<tr>
				<form action="add-item.php" method="POST">
					<td><input type="number" name="item_no" value="<?php echo $item_no; ?>" class="td_itemno"></td>
					<td><input type="text" name="item_name" class="td_itemname"></td>
					<td><input type="number" name="quantity" id="quantity" class="td_money" onchange="calc_ammount()"></td>
					<td><input type="number" name="item_price" id="item_price" class="td_price" onchange="calc_ammount()"></td>
					<td><input type="number" name="discount" id="discount" class="td_money" onchange="calc_ammount()"></td>
					<td><input type="number" name="ammount" id="ammount" class="td_money"></td>
					<td><input type="submit" name="Add" id="add_btn" value="Add" class="submit-button" onclick="remove_unload_event()"></td>
				</form>
			</tr>
		</table>
		<table style="width: 100%;">
			<tr>
				<form action="close-bill.php" method="POST" target="_blank">
					<input type="hidden" name="bill-no" value="<?php echo $bill_no ?>">
					<input type="hidden" name="bill-name" value="<?php echo $bill_name ?>">
					<td><input type="submit" name="CLOSE & PRINT BILL" id="add_btn" value="CLOSE & PRINT BILL" class="submit-button"></td>
					</form>
					<form action="print-bill.php" method="POST" target="_blank">
					<input type="hidden" name="bill-no" value="<?php echo $bill_no ?>">
					<input type="hidden" name="bill-name" value="<?php echo $bill_name ?>">
					<td><input type="submit" name="PRINT BILL" id="add_btn" value="ONLY PRINT BILL" class="submit-button"></td>
					</form>
				</td>
			</tr>
		</table>
	</div>
</body>
<script>
function remove_unload_event()
{
	window.removeEventListener("beforeunload",myFunction);
}
function myFunction() {
  return "Write something clever here...";
}
function calc_ammount()
{
	var q = document.getElementById("quantity").value;
	var p = document.getElementById("item_price").value;
	var d = document.getElementById("discount").value;
	d = d/100;
	var td = p * d;
	var tp = p - td;
	var ta = tp * q;
	document.getElementById("ammount").value = ta;
}
</script>
</html>