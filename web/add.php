<?php 
ob_start();
session_start(); 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">


<title>Add</title>


<style>

	body 
	{
		text-align: center;
		min-width: 500px;
		font: 18px tahoma;
	}
	fieldset 
	{
		width: 490px;
		margin: auto;
		background: #e6e6e6;
		border: 1px solid black;
		border-radius: 4px
	}
	legend 
	{
		text-align: left;
		color: navy;
		font: 20px tahoma;
	}
	form 
	{
		text-align: left;
	}	
	label 
	{
		display: inline-block;
		width: 100px;
		text-align: right;
		font: 18px tahoma;
	}
	label.float 
	{
		float: left;
		margin-right: 4px !important;
		font: 18px tahoma;
	}
	textarea 
	{
		float: left;
		width: 200px;
		height: 40px;
		resize: none;
		overflow: auto;
		font: 18px tahoma;
	}
	select 
	{
		border: solid 1px gray;
		width: 150px;
		margin: 3px;
		padding: 3px;
		border-radius: 2px;	
		font: 18px tahoma;
	}
	input
	{
		border: solid 1px gray;
		width: 340px;
		margin: 3px;
		padding: 3px;
		border-radius: 2px;	
		font: 18px tahoma;
	}
	button 
	{
		border:solid 1px #000000;
		border-radius: 3px;
		padding: 3px 20px;
		margin-left: 72%;
		font: 18px tahoma;
	}
	br.clear 
	{
		clear: left;
	}
	h3, p 
	{
		text-align: center;
	}
	
</style>

<?php

if($_POST)
{
	$table = $_POST["branch"];
	$branch = $_POST["branch"];
	$room = $_POST["room"];
	$instrument = $_POST["instrument"];
	$quantity = $_POST["quantity"];
	$caretaker = $_POST["caretaker"];
	$image = $_POST["image"];

	// Create connection
	$conn = new mysqli("db","root","root","laboratory_system");
	// Check connection
	if ($conn->connect_error)
	{
	die("Connection failed: " . $conn->connect_error);
	}

	$sql = "INSERT INTO $table (branch, room, instrument, quantity, caretaker, image)
	VALUES ('$branch', '$room', '$instrument', '$quantity', '$caretaker', '$image')";

	if ($conn->query($sql) === TRUE) {
	echo "<a style = 'color:green'>บันทึกข้อมูลสำเร็จ</a><br/>";
	echo "<a style = 'color:green'>โปรด Refresh หน้าหลักเพื่ออัพเดทข้อมูล</a>&nbsp;<a style = 'color:green,font-size: 24px;' href='javascript:window.close();'>ปิด</a>";
	} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}
?>

<fieldset><legend>เพิ่มข้อมูล</legend>
<form method="post">

  <label for="branch">สาขา:</label>
  <select id="branch" name="branch">
  	<option value="civil">โยธา</option>
    <option value="electrical">ไฟฟ้า</option>
    <option value="mechanical">เครื่องกล</option>
    <option value="industrial">อุตสาหการ</option>
	<option value="computer">คอมพิวเตอร์</option>
  </select>
 
  <br>

  <label for="room">ห้อง:</label>
  <input type="text" id="room" name="room"><br>
  <label for="instrument">ชื่ออุปกรณ์:</label>
  <input type="text" id="instrument" name="instrument"><br>
  <label for="quantity">จำนวน:</label>
  <input style="width: 150px;" type="number" id="quantity" name="quantity"><br>
  <label for="caretaker">ผู้ดูแล:</label>
  <input type="text" id="caretaker" name="caretaker"><br>
  <label for="caretaker">รูปภาพ:</label>
  <input type="text" id="image" name="image"><br><br>

  <button type="submit" value="Submit">ส่งข้อมูล</button>
  

</form> 
</fieldset>

</div>

</body>
</html>
