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
if(isset($_SESSION['name'])&&isset($_GET['id'])) 
    {
        $key_id = $_GET['id'];

        $conn = new mysqli("db","root","root","laboratory_system");
        if ($conn->connect_error){die("Connection failed: " . $conn->connect_error);}// Check connection

        $sql = "SELECT * FROM engineering_lab WHERE id = $key_id";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result);
    }
    else
    {
        echo "<h3>กระบวนการไม่ถูกต้อง</h3>";
        back();
    }
?>


<?php
if($_POST['id'])
{
    $id = $_POST['id'];
    $branch = $_POST['branch'];
    $room = $_POST['room'];
    $instrument = $_POST['instrument'];
    $quantity = $_POST['quantity'];
    $caretaker = $_POST['caretaker'];
    $image = $_POST['image'];

	$conn = new mysqli("db","root","root","laboratory_system");// Create connection
	if ($conn->connect_error){die("Connection failed: " . $conn->connect_error);}// Check connection

    $sql = "REPLACE INTO engineering_lab (id, branch, room, instrument, quantity, caretaker, image)
    VALUES ('$id', '$branch', '$room', '$instrument', '$quantity', '$caretaker', '$image');";

    $replace = mysqli_query($conn,$sql);

    if(!$replace)
    {
        echo "<h3 style = 'color:red'>การเพิ่มข้อมูล เกิดข้อผิดพลาด</h3>";
        echo mysqli_error($conn);
    }
    else
    {

        $show_id = mysqli_insert_id($conn); 

        $sql = "SELECT * FROM engineering_lab WHERE id = $show_id";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result);

        echo "<h3 style = 'color:green'>ข้อมูลถูกแก้ไขแล้ว</h3>";
        back();
    }
}
?>


<?php
function back()
{
    $data = "";
    global $conn;
    mysqli_close($conn);
    header("refresh: 2; url=index.php");
}
//mysqli_close($conn)
?>


<fieldset><legend>แก้ไขข้อมูล</legend>
<form method="post">

    <label>id:</label>
    <input style="width: 82px; background-color: #e6e6e6" type="text" id="id" name="id" value="<?php echo $data['id']; ?>" readonly><br>

    <label for="branch">สาขา:</label>
    <select id="branch" name="branch">
        <option value='โยธา' <?php echo ($data['branch'] == 'โยธา' ? "selected" : ""); ?>>โยธา</option>
        <option value='ไฟฟ้า' <?php echo ($data['branch'] == 'ไฟฟ้า' ? "selected" : ""); ?>>ไฟฟ้า</option>
        <option value='เครื่องกล' <?php echo ($data['branch'] == 'เครื่องกล' ? "selected" : ""); ?>>เครื่องกล</option>
        <option value='อุตสาหการ' <?php echo ($data['branch'] == 'อุตสาหการ' ? "selected" : ""); ?>>อุตสาหการ</option>
        <option value='คอมพิวเตอร์' <?php echo ($data['branch'] == 'คอมพิวเตอร์' ? "selected" : ""); ?>>คอมพิวเตอร์</option>
    </select><br>

  <label for="room">ห้อง:</label>
  <input type="text" id="room" name="room" value="<?php echo $data['room']; ?>"><br>

  <label for="instrument">ชื่ออุปกรณ์:</label>
  <input type="text" id="instrument" name="instrument" value="<?php echo $data['instrument']; ?>"><br>

  <label for="quantity">จำนวน:</label>
  <input style="width: 150px;" type="number" id="quantity" name="quantity" value="<?php echo $data['quantity']; ?>"><br>

  <label for="caretaker">ผู้ดูแล:</label>
  <input type="text" id="caretaker" name="caretaker" value="<?php echo $data['caretaker']; ?>"><br>

  <label for="caretaker">รูปภาพ:</label>
  <input type="text" id="image" name="image" value="<?php echo $data['image']; ?>"><br><br>

  <div class="button"><button type="submit" value="Submit">ส่งข้อมูล</button>&nbsp;&nbsp;<a class="back" href="index.php">ย้อนกลับ</a></div>
  
  
</form> 
</fieldset>

</body>
</html>