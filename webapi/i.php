<?php
$conn = mysqli_connect("localhost", "dukeinfo_amsons", "vivek@1976", "dukeinfo_amsons");

if (isset($_POST["import"])) {

$fileName = $_FILES["file"]["tmp_name"];

if ($_FILES["file"]["size"] > 0) {

$file = fopen($fileName, "r");

while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {

    $sql = "SELECT id FROM tbl_ro_dop WHERE id='$column[0]'";
    $resuleet = $conn->query($sql);
    
    if ($resuleet->num_rows > 0) {}else {

  echo $sqlInsert = "INSERT INTO  `tbl_ro_dop`(`id`, `ro_id`, `ro_no`, `work_year`, `paper_id`, `price`, `eprice`, `dop`, `dop_amount`, `bill_dop`, `bill_inse`, `bill_number`, `bill_status`, `p_bill_dop`, `news_bill_status`, `newspaper_bill`, `c_date`) VALUES ('$column[0]','$column[1]','$column[2]','$column[3]','$column[4]','$column[5]','$column[6]','$column[7]','$column[8]','$column[9]','$column[10]','$column[11]','$column[12]','$column[13]','$column[14]','$column[15]','$column[16]')";   
  echo "<br>";
}
$result = mysqli_query($conn, $sqlInsert);

if (! empty($result)) {
$type = "success";
$message = "CSV Data Imported into the Database";
} else {
$type = "error";
$message = "Problem in Importing CSV Data";
}
}
}
}
?>
<!DOCTYPE html>
<html>

<head>
<script src="jquery-3.2.1.min.js"></script>

<style>
body {
font-family: Arial;
width: 550px;
}

.outer-scontainer {
background: #F0F0F0;
border: #e0dfdf 1px solid;
padding: 20px;
border-radius: 2px;
}

.input-row {
margin-top: 0px;
margin-bottom: 20px;
}

.btn-submit {
background: #333;
border: #1d1d1d 1px solid;
color: #f0f0f0;
font-size: 0.9em;
width: 100px;
border-radius: 2px;
cursor: pointer;
}

.outer-scontainer table {
border-collapse: collapse;
width: 100%;
}

.outer-scontainer th {
border: 1px solid #dddddd;
padding: 8px;
text-align: left;
}

.outer-scontainer td {
border: 1px solid #dddddd;
padding: 8px;
text-align: left;
}

#response {
padding: 10px;
margin-bottom: 10px;
border-radius: 2px;
display:none;
}

.success {
background: #c7efd9;
border: #bbe2cd 1px solid;
}

.error {
background: #fbcfcf;
border: #f3c6c7 1px solid;
}

div#response.display-block {
display: block;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
$("#frmCSVImport").on("submit", function () {

$("#response").attr("class", "");
$("#response").html("");
var fileType = ".csv";
var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
if (!regex.test($("#file").val().toLowerCase())) {
$("#response").addClass("error");
$("#response").addClass("display-block");
$("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
return false;
}
return true;
});
});
</script>
</head>

<body>
<h2>Import CSV file into Mysql using PHP</h2>

<div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
<div class="outer-scontainer">
<div class="row">

<form class="form-horizontal" action="" method="post"
name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
<div class="input-row">
<label class="col-md-4 control-label">Choose CSV
File</label> <input type="file" name="file"
id="file" accept=".csv">
<button type="submit" id="submit" name="import"
class="btn-submit">Import</button>
<br />

</div>

</form>

</div>
<?php
$sqlSelect = "SELECT * FROM users";
$result = mysqli_query($conn, $sqlSelect);

if (mysqli_num_rows($result) > 0) {
?>
<table id='userTable'>
<thead>
<tr>
<th>User ID</th>
<th>User Name</th>
<th>First Name</th>
<th>Last Name</th>

</tr>
</thead>
<?php

while ($row = mysqli_fetch_array($result)) {
?>

<tbody>
<tr>
<td><?php  echo $row['userId']; ?></td>
<td><?php  echo $row['userName']; ?></td>
<td><?php  echo $row['firstName']; ?></td>
<td><?php  echo $row['lastName']; ?></td>
</tr>
<?php
}
?>
</tbody>
</table>
<?php } ?>
</div>

</body>

</html>