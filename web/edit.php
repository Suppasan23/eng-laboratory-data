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
	else if($action == "edit") //ถ้า Action เป็นการแก้ไขข้อมูล ต้องอ่านข้อมูลเดิมมาเติมลงในฟอร์ม
    {
        $h = "แก้ไขข้อมูล";
        $sql = "SELECT * FROM engineering_lab WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result);
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
}
?>

<?php
if($_POST['id'])
{
	$conn = new mysqli("db","root","root","laboratory_system");// Create connection
	if ($conn->connect_error){die("Connection failed: " . $conn->connect_error);}// Check connection

    $values = implode("', '", $_POST);
    $values = "'".$values."'";

    $sql = "REPLACE INTO engineering_lab VALUES($values);";

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
//mysqli_close($conn)
?>

<fieldset><legend><?php echo $h; ?></legend>
<form method="post">

    <label>id:</label>
    <input style="width: 82px;" type="text" id="id" name="id" value="<?php echo $data['id']; ?>" placeholder="<?php echo (empty($data['id']) ? "ไม่ต้องระบุ" : $data['id']); ?>" disabled><br>

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