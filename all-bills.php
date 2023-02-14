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
		<a href="all-bills.php" style="text-decoration: none;" class="side-menu-button-active">
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
	<div class="display-table-bg">
		<table class="display-table">
			<thead style="border-bottom:1px solid grey; padding-bottom: 10px;">
				<tr style="border-bottom: 1px solid grey">
					<th style="padding-bottom: 10px;">Bill no</th>
					<th style="padding-bottom: 10px;">Billed To</th>
					<th style="padding-bottom: 10px;">Billed By</th>
					<th style="padding-bottom: 10px;">No.of Items</th>
					<th style="padding-bottom: 10px;">Total</th>
					<th style="padding-bottom: 10px;">Status</th>
					<th style="padding-bottom: 10px;">Paid via</th>
					<th style="padding-bottom: 10px; text-align: center;">Update</th>
					<th style="padding-bottom: 10px; text-align: center;">Print</th>
				</tr>
			</thead>
		    <?php
		    session_start();
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
			$sql = "SELECT * FROM WebBiller ORDER BY bill_no";
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()) 
			{
				$bill_name = "bill".$row['bill_no'];
				$label_id = $row['label_id'];
				$status = "";
				$update = "";
				$paid_via = "";
				if ($row['status'] == "P") 
				{
					echo "<tr>";
					$status = "Paid";
					$to_set = "N";
					$update = "As Not Paid";
				}
				else
				{
					echo "<tr style='background-color:red; color : white;'>";
					$status = "Not Paid";
					$to_set = "P";
					$update = "As Paid";
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
				echo "<td style='padding-left : 5px;'>".$row['bill_no']."</td>"."<td>".$row['billed_to']."</td>"."<td>".$row['billed_by']."</td>"."<td>".$row['no_of_items']."</td>"."<td>".$row['total']."</td>"."<td>".$status."</td>"."<td>".$paid_via."</td>";
				// echo"<td><form action = 'update.php' method='post'> <input type='hidden' name = 'bill-no' value = ' ".$row['bill_no']." '><input type='hidden' name = 'status' value = '".$to_set."'> ". "<input  class='submit-button' type='submit' value=' ".$update."'></td></form> ";
				echo "<td><form action='edit-bill.php' method='POST' target='_blank'><input type='hidden' name = 'bill-no' value = ' ".$row['bill_no']." '><input type='hidden' name = 'bill-name' value = ' ".$bill_name." '><input type='hidden' name = 'label_id' value = ' ".$label_id." '><input class='submit-button' style='width : 90%;' type='submit' value='Edit'></form></td>";
				echo "<td><form action='print-bill.php' method='POST' target='_blank'><input type='hidden' name = 'bill-no' value = ' ".$row['bill_no']." '><input type='hidden' name = 'bill-name' value = ' ".$bill_name." '><input  class='submit-button' style='width : 90%;' type='submit' value=' PRINT'></form></td>";
			}
			?>
			</tr>
		</table>
	</div>
</body>
</html>