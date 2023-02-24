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
    $id = $_GET['id'];

    $conn = new mysqli("db","root","root","laboratory_system");
    if ($conn->connect_error){die("Connection failed: " . $conn->connect_error);}// Check connection

    $sql = "DELETE FROM engineering_lab WHERE id = $id";
    $delete = mysqli_query($conn , $sql);
    if(!$delete)
        {
            $success = false;
            echo mysqli_error($conn);
        }
        else
        {
            $success = true;
            echo "<h3>ข้อมูลถูกลบแล้ว</h3>";
            back();
        }
}
?>

<?php
function back()
{
    $success = false;
    global $conn;
    mysqli_close($conn);
    header("refresh: 2; url=index.php");
}
//mysqli_close($conn)
?>

<fieldset><legend><?php echo $success ? "" : "คุณต้องการลบข้อมูลต่อไปนี้ใช่หรือไม่?" ; ?></legend>

<form method="post">

    <label>id:</label>
    <input style="width: 82px; background-color: #e6e6e6" type="text" id="id" name="id" value="<?php echo $success ? "" : $data['id'] ; ?>" readonly><br>

    <label for="branch">สาขา:</label>
    <select style="background-color: #e6e6e6;" id="branch" name="branch" readonly>
        <option value="<?php echo $success ? "" : $data['branch'] ; ?>"><?php echo $success ? "" : $data['branch'] ; ?></option>
    </select><br>

  <label for="room">ห้อง:</label>
  <input style="background-color: #e6e6e6;" type="text" id="room" name="room" value="<?php echo $success ? "" : $data['room'] ; ?>" readonly><br>

  <label for="instrument">ชื่ออุปกรณ์:</label>
  <input style="background-color: #e6e6e6;" type="text" id="instrument" name="instrument" value="<?php echo $success ? "" : $data['instrument'] ; ?>" readonly><br>

  <label for="quantity">จำนวน:</label>
  <input style="background-color: #e6e6e6;" style="width: 150px;" type="number" id="quantity" name="quantity" value="<?php echo $success ? "" : $data['quantity'] ; ?>" readonly><br>

  <label for="caretaker">ผู้ดูแล:</label>
  <input style="background-color: #e6e6e6;" type="text" id="caretaker" name="caretaker" value="<?php echo $success ? "" : $data['caretaker'] ; ?>" readonly><br>

  <label for="caretaker">รูปภาพ:</label>
  <input style="background-color: #e6e6e6;" type="text" id="image" name="image" value="<?php echo $success ? "" : $data['image'] ; ?>" readonly><br><br>

  <div class="button"><button type="submit" value="Submit">ลบข้อมูล</button>&nbsp;&nbsp;<a class="back" href="index.php">ย้อนกลับ</a></div>
  
  
</form> 
</fieldset>

</body>
</html>