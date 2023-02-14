<?php
session_start();
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
		$billed_by = $row['billed_by'];
		$total = $row['total'];
		$no_of_items = $row['no_of_items'];
		$total_paid = $row['total_paid'];
		$paid_via = $row['paid_via'];
		$billed_on = $row['billed_on'];
		$billed_on_time = $row['billed_on_time'];
		$paid_on = $row['paid_on'];
		if($paid_on == "00-00-0000")
		{
			$paid_on = $billed_on;
		}
		$paid_on_time = $row['paid_on_time'];
		if($paid_on_time == "00-00-00")
		{
			$paid_on_time = $billed_on_time;
		}
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
</head>
<body>
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
	<div id="new-bill-creation" class="new-bill-form">
		<form action="close-bill-save.php" method="POST" id="close-bill" >
			<input type="hidden" name="bill-no" value="<?php echo $bill_no ?>">
			<input type="hidden" name="bill-name" value="<?php echo $bill_name ?>">
			<input type="hidden" name="no_of_items" value="<?php echo $no_of_items ?>">
			<p style="text-align: center; font-size: 20px; text-shadow: 1px 1px 3px grey;">Enter the details for the Bill</p>
			<table style="margin-left: auto; margin-right: auto; background-color: white; border-radius: 10px; border-width: 15px; width: 60%; padding-right: 20px;">
				<tr>
					<td style="text-align: right; width: 40%;"><p>Billing To : </p></td>
					<td><input type="text" name="billed-to" class="new-bill-text" value="<?php echo $billed_to; ?>"></td>
				</tr>
				<tr>
					<td style="text-align: right;"><p>Billing To Contact: </p></td>
					<td><input type="text" name="billed-to-contact" class="new-bill-text" value="<?php echo $billed_to_contact; ?>"></td>
				</tr>
				<tr>
					<td style="text-align: right;"><p>Billing By : </p></td>
					<td><input type="text" name="billed-by" class="new-bill-text" value="<?php echo $billed_by; ?>"></td>
				</tr>
				<tr>
					<td style="text-align: right;"><p>Bill label : </p></td>
					<td>
						<div class="custom-select">
							<select name="bill-label" id="bill_label">
								<option value="D">Default</option>
								<option value="D">Default</option>
								<option value="C1">Type1</option>
								<option value="C2">Type2</option>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td style="text-align: right;"><p>Amount to be paid (₹) : </p></td>
					<td><input type="text" name="total" class="new-bill-text" value="<?php echo $total; ?>"></td>
				</tr>
				<tr>
					<td style="text-align: right;"><p>Total Paid (₹) : </p></td>
					<td><input type="text" name="total-paid" class="new-bill-text" value="0"></td>
				</tr>
				<tr>
					<td style="text-align: right;"><p>Paid Via : </p></td>
					<td>
						<div class="custom-select">
							<select name="paid-via" id="paid_via">
								<option value="N">NIL</option>
								<option value="N">NIL</option>
								<option value="O">Online</option>
								<option value="C">Cash</option>
								<option value="H">Cheque</option>
								<option value="B">Bank Transfer</option>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td style="text-align: right;"><p>Billed On (DD:MM:YY) : </p></td>
					<td><input type="text" name="billed-on" class="new-bill-text" value="<?php echo $billed_on; ?>"></td>
				</tr>
				<tr>
					<td style="text-align: right;"><p>Billed Time (hh:mm:ss) : </p></td>
					<td><input type="text" name="billed-on-time" class="new-bill-text" value="<?php echo $billed_on_time; ?>"></td>
				</tr>
				<tr>
					<td style="text-align: right;"><p>Paid On (DD:MM:YY) : </p></td>
					<td><input type="text" name="paid-on" class="new-bill-text" value="<?php echo $paid_on; ?>"></td>
				</tr>
				<tr>
					<td style="text-align: right;"><p>Paid Time (hh:mm:ss) : </p></td>
					<td><input type="text" name="paid-on-time" class="new-bill-text" value="<?php echo $paid_on_time; ?>"></td>
				</tr>
			</table>
			<div style="text-align: center; margin-top: 20px;">
				<input type="submit" value="Save & Print" class="submit-button" style="padding: 20px; border-radius: 15px; border-width: 0px;">
			</div>
		</form>
	</div>
</body>
<script>
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>
</html>