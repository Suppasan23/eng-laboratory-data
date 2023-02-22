<?php 
ob_start();
session_start(); 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>Edit</title>

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
    div.button
    {
        text-align: right;
        margin-right: 3%;
        
    }

	
</style>

<?php
if(!isset($_SESSION['name'])) {
	echo "<h3>ท่านยังไม่ได้ทำการล็อคอิน</h3>";
	Close();
	}

if(!isset($_GET['action'])) {
    echo "<h3>กระบวนการไม่ถูกต้อง</h3>";
    Close();
    }

if(isset($_GET['action']))
{
    $action = $_GET['action'];
    $id = $_GET['id'];

    $conn = new mysqli("db","root","root","laboratory_system");
	if ($conn->connect_error){die("Connection failed: " . $conn->connect_error);}// Check connection


    if($action == "insert") //ถ้า Action เป็นการเพิ่ม
    {
        $h = "เพิ่มข้อมูล";
    }
    else if($action == "delete") //ถ้า Action เป็นการลบ ก็นำค่า id ไปกำหนดเป็นเงื่อนไขการลบ
    {
        $sql = "DELETE FROM engineering_lab WHERE id = $id";
        $delete = mysqli_query($conn , $sql);
        if(!$delete)
            {
                echo mysqli_error($conn);
            }
            else
            {
                echo "<h3>ข้อมูลถูกลบแล้ว</h3>";
                back();
            }
    }
    else if($action == "edit") //ถ้า Action เป็นการแก้ไขข้อมูล ต้องอ่านข้อมูลเดิมมาเติมลงในฟอร์ม
    {
        $h = "แก้ไขข้อมูล";
        $sql = "SELECT * FROM engineering_lab WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result);
    }
}
?>

<?php
if($_POST['id'])
{
	$conn = new mysqli("db","root","root","laboratory_system");// Create connection
	if ($conn->connect_error){die("Connection failed: " . $conn->connect_error);}// Check connection

    $values = implode("', '", $_POST);
    $values = "'".$values."'";

    $sql = "REPLACE INTO engineering_lab (id, branch, room, instrument, quantity, caretaker, image)
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
    header("refresh: 1; url=index.php");
}
//mysql_close($conn);
?>

<fieldset><legend><?php echo $h; ?></legend>
<form method="post">

    <label>id:</label>
    <input style="width: 100px;" type="text" id="id" name="id" value="<?php echo $data['id']; ?>" 
    placeholder="<?php echo (empty($data['branch']) ? "ไม่ต้องระบุ" : $data['branch']); ?>" disabled><br>

    <label for="branch">สาขา:</label>
    <select id="branch" name="branch">
        <option value='โยธา' <?php if ($data['branch'] == 'โยธา') echo 'selected'; ?>>โยธา</option>
        <option value='ไฟฟ้า' <?php if ($data['branch'] == 'ไฟฟ้า') echo 'selected'; ?>>ไฟฟ้า</option>
        <option value='เครื่องกล' <?php if ($data['branch'] == 'เครื่องกล') echo 'selected'; ?>>เครื่องกล</option>
        <option value='อุตสาหการ' <?php if ($data['branch'] == 'อุตสาหการ') echo 'selected'; ?>>อุตสาหการ</option>
        <option value='คอมพิวเตอร์' <?php if ($data['branch'] == 'คอมพิวเตอร์') echo 'selected'; ?>>คอมพิวเตอร์</option>
    </select><br>

  <label for="room">ห้อง:</label>
  <input type="text" id="room" name="room" value="<?php echo $data['room'] ?>"><br>

  <label for="instrument">ชื่ออุปกรณ์:</label>
  <input type="text" id="instrument" name="instrument" value="<?php echo $data['instrument'] ?>"><br>

  <label for="quantity">จำนวน:</label>
  <input style="width: 150px;" type="number" id="quantity" name="quantity" value="<?php echo $data['quantity'] ?>"><br>

  <label for="caretaker">ผู้ดูแล:</label>
  <input type="text" id="caretaker" name="caretaker" value="<?php echo $data['caretaker'] ?>"><br>

  <label for="caretaker">รูปภาพ:</label>
  <input type="text" id="image" name="image" value="<?php echo $data['image'] ?>"><br><br>

  <div class="button"><button type="submit" value="Submit">ส่งข้อมูล</button>&nbsp;&nbsp;<a class="back" href="index.php">ย้อนกลับ</a></div>
  
  
</form> 
</fieldset>

</body>
</html>