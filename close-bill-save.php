<?php
session_start();
$bill_no = $_POST['bill-no'];
$bill_name = $_POST['bill-name'];
$no_of_items = $_POST['no_of_items'];
$billed_to = $_POST['billed-to'];
$billed_to_contact = $_POST['billed-to-contact'];
$billed_by = $_POST['billed-by'];
$label_id = $_POST['bill-label'];
$total = $_POST['total'];
$total_paid = $_POST['total-paid'];
$paid_via = $_POST['paid-via'];
$billed_on = $_POST['billed-on'];
$billed_on_time = $_POST['billed-on-time'];
$paid_on = $_POST['paid-on'];
$paid_on_time = $_POST['paid-on-time'];
$status = " ";
if ($paid_via == "N") 
{
	$status = "N";
}
else
{
	$status = "P";
}
// echo $bill_no."<br>";
// echo $bill_name."<br>";
// echo $no_of_items."<br>"; 
// echo $billed_to."<br>";
// echo $billed_to_contact."<br>"; 
// echo $billed_by."<br>";
// echo $bill_label."<br>";
// echo $total."<br>";
// echo $total_paid."<br>";
// echo $paid_via."<br>"; 
// echo $billed_on."<br>";
// echo $billed_on_time."<br>";
// echo $paid_on."<br>"; 
// echo $paid_on_time."<br>";
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
$sql = "DELETE FROM WebBiller where bill_no = '$bill_no'";
if ($conn->query($sql)) 
{
	$sql = "INSERT INTO WebBiller (bill_no, billed_to, billed_to_contact, billed_by, no_of_items, total, total_paid, status, paid_via, billed_on, paid_on, billed_on_time, paid_on_time, label_id) VALUES ( '$bill_no' , '$billed_to', '$billed_to_contact', '$billed_by', '$no_of_items', '$total', '$total_paid', '$status', '$paid_via', '$billed_on', '$paid_on', '$billed_on_time', '$paid_on_time' , '$label_id')";
	if ($conn->query($sql)) 
	{
		$sql = "SELECT * FROM WebBiller ORDER BY bill_no";
		if ($conn->query($sql)) 
		{
			// echo "ORDERED";
		}
		else
		{
			echo "Error saving Bill: " . $conn->error;
		}
	}
	else
	{
		echo "Error saving Bill: " . $conn->error;
	}
}
else
{
	echo "Error saving draft table: " . $conn->error;
}
?>
<?php
$page_no = 1;
$bill_no = $_POST['bill-no'];
$bill_name = $_POST['bill-name'];
$total = 0;
$total_paid = 0;
$paid_via = " ";
$status = " ";
// $billed_to = $_POST['billed-to'];
// $billed_by = $_POST['billed-by'];
// $bill_label = $_POST['bill-label'];
date_default_timezone_set('Asia/Kolkata');
$print_on = date('d-m-y');
$print_on_time = date('h:i:s');
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
$sql = "SELECT * FROM WebBiller where bill_no='$bill_no'";
if ($result = $conn->query($sql)) 
{
	while($row = $result->fetch_assoc())
	{
		$billed_to = $row['billed_to'];
		$billed_to_contact = $row['billed_to_contact'];
		$total = $row['total'];
		$total_paid = $row['total_paid'];
		$paid_via = $row['paid_via'];
		$billed_on = $row['billed_on'];
		$billed_on_time = $row['billed_on_time'];
		$paid_on = $row['paid_on'];
		$paid_on_time = $row['paid_on_time'];
		$label_id = $row['label_id'];
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
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Calanjiyam Web Biller</title>
	<link rel="icon" type="image/png" href="http://crisscrosstamizh.tech/GST-Dev/assets/img/light_cct.png">
	<link href="style.css" rel="stylesheet">
	<style>
		@media screen 
		{
		  div.divFooter 
		  {
		    display: none;
		  }
		}
		@media print 
		{
		  div.divFooter 
		  {
		    position: fixed;
		    bottom: 0;
		    text-align: center;
		  }
		  body
		  {
		  	background-color: white;
		  }
		}
	</style>
</head>
<body style="margin-bottom: 100px;">
	<div id="new-bill-area" class="new-bill-area">
		<?php
				$sql = "SELECT * FROM bill_label where label_id='$label_id'";
				// echo $label_id;
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
		<table style="width: 100%; font-size: 12px;">
			<tr style="border : 1px solid grey;">
				<td style="padding : 10px;">Billing To</td>
				<td style="padding : 10px;"><?php echo $billed_to.", ".$billed_to_contact; ?></td>
				<td></td><td></td>
				<td style="padding : 10px; text-align: right;">Paid Via</td>
				<td style="padding : 10px;text-align: left; width: 100px;"><?php echo $paid_via; ?></td>		
			</tr>
			<tr>
				<td style="padding: 10px; width: 30px;">Total amount to be paid
				<td style="padding: 10px;"><?php echo "₹".$total."/-"; ?>
				<td></td><td></td>
				<td style="padding : 10px;text-align: right;">Total amount paid
				<td style="padding : 10px;text-align: left;"><?php echo "₹".$total_paid."/-"; ?>
			</tr>
			<tr>
				<td style="padding: 10px;"><p>Billed on <br><br> DD-MM-YY <br><br> hh:mm:ss</p></td>
				<td style="padding: 10px;"><p><?php echo "<br><br>".$billed_on."<br><br>".$billed_on_time; ?></p></td>
				<td></td><td></td>
				<td style="padding : 10px;text-align: right;"><p>Paid On<br><br> DD-MM-YY <br><br> hh:mm:ss</p></td>
				<td style="padding : 10px;text-align: left;"><p><?php echo "<br><br>".$paid_on."<br><br>".$paid_on_time; ?></p></td>
			</tr>
			<tr>
				
			</tr>
			<tr>
				
			</tr>
		</table>
		<table id="bill-creation-table" class="bill-creation-table">
			<tr style="text-align: center; color: #004A98; text-shadow: 0px 0px 0px grey;">
				<th class="itemno" style="text-align: center;text-shadow: 0px 0px 0px grey;">Item No</th>
				<th class="itemname" style="text-align: center;text-shadow: 0px 0px 0px grey;">Item Name</th>
				<th class="th_money" style="text-align: center;text-shadow: 0px 0px 0px grey;">Quantity</th>
				<th class="tr_price" style="text-align: center;text-shadow: 0px 0px 0px grey;">Price(₹)</th>
				<th class="th_money" style="text-align: center;text-shadow: 0px 0px 0px grey;">Discount(%)</th>
				<th class="th_money" style="text-align: center;text-shadow: 0px 0px 0px grey;">Ammount(₹)</th>
			</tr>
			<?php
			$sql = "SELECT * FROM $bill_name";
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()) 
			{
				echo "<tr style='border: 1px solid black;''><td class='display_td'>".$row['item_no']."</td><td class='display_td'>".$row['item_name']."</td><td class='display_td'>".$row['quantity']."</td><td class='display_td'>".$row['price']."</td><td class='display_td'>".$row['discount']."</td><td class='display_td'>".$row['amount']."</td></tr>";
			}
			?>
			<tfoot style="width: 100%;bottom: 0; font-size: 10px;">
				<tr style="width: 100%; text-align: center;">
					<td colspan="6">
						<p>
							Calanjiyam Consultancies and Technologies<br>
							316, North Street, Sooriyampalayam, Odathurai,Erode, Tamil Nadu - 638455<br>
							+918667280728, info@crisscrosstamizh.in<br>
						</p>
						<p>Invoice Reg no - <?php echo $bill_no; ?></p>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<script>
		window.print();
	</script>
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