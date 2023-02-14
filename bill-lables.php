<?php
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
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Calanjiyam Web Biller</title>
	<link rel="icon" type="image/png" href="http://crisscrosstamizh.tech/GST-Dev/assets/img/light_cct.png">
	<link href="style.css" rel="stylesheet" >
</head>
<body>
	<span class="left-corner-heading">
		<h1 style="font-weight: 400;">
			<img src="http://crisscrosstamizh.tech/GST-Dev/assets/img/dark_cct.png" class="left-corner-heading-img">Calanjiyam - Web Biller</h1>
	</span>
	<div id="top-menu" class="top-menu">
		<a href="new-bill.php" style="text-decoration: none;" class="side-menu-button">
			<i class="bi bi-file-earmark-plus" style="padding: 8px; margin-right: 10px; font-size: 15px;"></i>New Bill
		</a>
		<a href="all-bills.php" style="text-decoration: none;" class="side-menu-button">
			<i class="bi bi-folder" style="padding: 8px; margin-right: 10px; font-size: 15px;"></i>All Bills
		</a>
		<a href="bill-lables.php" style="text-decoration: none;" class="side-menu-button-active">
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
	<div id="bill-lables-display">
		<div id="bill-label-default" class="bill-labels">
			<?php
			$sql = "SELECT * FROM bill_label where label_id='d'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			?>
			<h2 class="label-id">Label - Default</h2>
			<table id="biller_details" style="width: 100%" class="biller_details">
				<tr>
					<td style="padding-top: 10px;	padding-bottom: 10px;"><img src="<?php echo $row['img_url']; ?>" style="width: 100px;"></td> 
					<td style="padding-top: 10px;	padding-bottom: 10px;">
						<h1 id="company_name" style="font-weight: 450; font-size: 24px; color : red;"><?php echo $row['company_name']; ?></h1>
						<p id="company_address"><?php echo $row['company_address']; ?></p>
						<p id="company_contact"><?php echo $row['company_contact']; ?></p>
					</td>
					<td style="color: #004A98;padding-top: 10px;	padding-bottom: 10px;">
						<form action="edit-bill-label.php" method="POST">
							<input type="hidden" name="label" value="d">
							<input type="submit" name="Edit" value="Edit" class="submit-button" style="padding: 15px; width: 100px;">
						</form>
					</td>
				</tr>
			</table>
		</div>
		<div id="bill-label-type1" class="bill-labels">
			<?php
			$sql = "SELECT * FROM bill_label where label_id='c1'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			?>
			<h2 class="label-id">Label - Custom 1</h2>
			<table id="biller_details" style="width: 100%" class="biller_details">
				<tr>
					<td><img src="<?php echo $row['img_url']; ?>" style="width: 100px;"></td> 
					<td>
						<h1 id="company_name" style="font-weight: 450; font-size: 24px; color : red;"><?php echo $row['company_name']; ?></h1>
						<p id="company_address"><?php echo $row['company_address']; ?></p>
						<p id="company_contact"><?php echo $row['company_contact']; ?></p>
					</td>
					<td style="color: #004A98;">
						<form action="edit-bill-label.php" method="POST">
							<input type="hidden" name="label" value="c1">
							<input type="submit" name="Edit" value="Edit" class="submit-button" style="padding: 15px; width: 100px;">
						</form>
					</td>
				</tr>
			</table>
		</div>
		<div id="bill-label-type2" class="bill-labels">
			<?php
			$sql = "SELECT * FROM bill_label where label_id='c2'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			?>
			<h2 class="label-id">Label - Custom 2</h2>
			<table id="biller_details" style="width: 100%" class="biller_details">
				<tr>
					<td><img src="<?php echo $row['img_url']; ?>" style="width: 100px;"></td> 
					<td>
						<h1 id="company_name" style="font-weight: 450; font-size: 24px; color : red;"><?php echo $row['company_name']; ?></h1>
						<p id="company_address"><?php echo $row['company_address']; ?></p>
						<p id="company_contact"><?php echo $row['company_contact']; ?></p>
					</td>
					<td style="color: #004A98;">
						<form action="edit-bill-label.php" method="POST">
							<input type="hidden" name="label" value="c2">
							<input type="submit" name="Edit" value="Edit" class="submit-button" style="padding: 15px; width: 100px;">
						</form>
					</td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>