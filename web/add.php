<?php 
ob_start();
session_start(); 
?>

<!DOCTYPE html>

<head>
<title>Engineering Laboratory</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="add_edit_delete_style.css" rel="stylesheet" type="text/css">
</head>

<?php
if(!isset($_SESSION['name'])) 
    {
        echo "<h3>กระบวนการไม่ถูกต้อง</h3>";
        back();
    }
?>

<?php
if($_POST)
{
    $branch = $_POST['branch'];
    $room = $_POST['room'];
    $instrument = $_POST['instrument'];
    $quantity = $_POST['quantity'];
    $caretaker = $_POST['caretaker'];
    $image = $_POST['image'];

	$conn = new mysqli("db","root","root","laboratory_system");// Create connection
	if ($conn->connect_error){die("Connection failed: " . $conn->connect_error);}// Check connection

    $sql = "INSERT INTO engineering_lab (branch, room, instrument, quantity, caretaker, image)
    VALUES ('$branch', '$room', '$instrument', '$quantity', '$caretaker', '$image');";

    $replace = mysqli_query($conn,$sql);

    if(!$replace)
    {
        echo mysqli_error($conn);
    }
    else
    {
        echo "<h3 style = 'color:green'>ข้อมูลถูกเพิ่มแล้ว</h3>";
        back();
    }
}
?>

<?php
function back()
{
    global $conn;
    mysqli_close($conn);
    header("refresh: 2; url=index.php");
}
//mysqli_close($conn)
?>

<fieldset><legend>เพิ่มข้อมูล</legend>
<form method="post">

    <label>id:</label>
    <input style="width: 82px; background-color: #e6e6e6" type="text" id="id" name="id" value="" placeholder="ไม่ต้องระบุ" readonly><br>

    <label for="branch">สาขา:</label>
    <select id="branch" name="branch">
        <option value='โยธา'>โยธา</option>
        <option value='ไฟฟ้า'>ไฟฟ้า</option>
        <option value='เครื่องกล'>เครื่องกล</option>
        <option value='อุตสาหการ'>อุตสาหการ</option>
        <option value='คอมพิวเตอร์'>คอมพิวเตอร์</option>
    </select><br>

  <label for="room">ห้อง:</label>
  <input type="text" id="room" name="room" value=""><br>

  <label for="instrument">ชื่ออุปกรณ์:</label>
  <input type="text" id="instrument" name="instrument" value=""><br>

  <label for="quantity">จำนวน:</label>
  <input style="width: 150px;" type="number" id="quantity" name="quantity" value=""><br>

  <label for="caretaker">ผู้ดูแล:</label>
  <input type="text" id="caretaker" name="caretaker" value=""><br>

  <label for="caretaker">รูปภาพ:</label>
  <input type="text" id="image" name="image" value=""><br><br>

  <div class="button"><button type="submit" value="Submit">ส่งข้อมูล</button>&nbsp;&nbsp;<a class="back" href="index.php">ย้อนกลับ</a></div>
  
  
</form> 
</fieldset>

</body>
</html>