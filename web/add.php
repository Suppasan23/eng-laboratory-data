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
if(isset($_POST['submit'])) 
{
    $file = $_FILES['file'];

    // file properties
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];

    // get file extension
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // allowed extensions
    $allowed = array('jpg', 'jpeg', 'png', 'gif', 'webp');

    if(in_array($file_ext, $allowed)) {
        if($file_error === 0) {
            if($file_size <= 1000000) 
            {
                // create new unique file name to avoid overwrite
                $new_file_name = uniqid('', true) . '.' . $file_ext;

                // file directory
                $file_destination = '../picture/' . $new_file_name;

                // move file to directory
                move_uploaded_file($file_tmp, $file_destination);
               
            } else {echo "File size is too large.";}
        } else {echo "Error uploading file.";}
    } else {echo "อนุญาติเฉพาะไฟล์ 'jpg', 'jpeg', 'png', 'gif', 'webp' เท่านั้น";}

    $branch = $_POST['branch'];
    $room = $_POST['room'];
    $instrument = $_POST['instrument'];
    $quantity = $_POST['quantity'];
    $caretaker = $_POST['caretaker'];
    $image = $_FILES['image']['name'];

    $conn = new mysqli("db","root","root","laboratory_system");// Create connection
    if ($conn->connect_error){die("Connection failed: " . $conn->connect_error);}// Check connection

    $sql = "INSERT INTO engineering_lab (branch, room, instrument, quantity, caretaker, image)
    VALUES ('$branch', '$room', '$instrument', '$quantity', '$caretaker', '$new_file_name');";

    $insert = mysqli_query($conn,$sql);

    if(!$insert)
    {
        $success = false;
        echo "<h3 style = 'color:red'>การเพิ่มข้อมูล เกิดข้อผิดพลาด</h3>";
        echo mysqli_error($conn);
    }
    else
    {
        $success = true;
        $show_id = mysqli_insert_id($conn); 
        echo "<h3 style = 'color:green'>ข้อมูลถูกเพิ่มแล้ว</h3>";
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

<fieldset><legend>เพิ่มข้อมูล</legend>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

    <label>id:</label>
    <input style="width: 82px; background-color: #e6e6e6" type="text" id="id" name="id" value="" placeholder="<?php echo $success ? "$show_id" : "ไม่ต้องระบุ"; ?>" readonly><br>

    <label for="branch">สาขา:</label>
    <select id="branch" name="branch">
        <option value='โยธา' <?php echo ($success&&($branch == 'โยธา') ? "selected" : ""); ?>>โยธา</option>
        <option value='ไฟฟ้า' <?php echo ($success&&($branch == 'ไฟฟ้า') ? "selected" : ""); ?>>ไฟฟ้า</option>
        <option value='เครื่องกล' <?php echo ($success&&($branch == 'เครื่องกล') ? "selected" : ""); ?>>เครื่องกล</option>
        <option value='อุตสาหการ' <?php echo ($success&&($branch == 'อุตสาหการ') ? "selected" : ""); ?>>อุตสาหการ</option>
        <option value='คอมพิวเตอร์' <?php echo ($success&&($branch == 'คอมพิวเตอร์') ? "selected" : ""); ?>>คอมพิวเตอร์</option>
    </select><br>

  <label for="room">ห้อง:</label>
  <input type="text" id="room" name="room" value="" placeholder="<?php echo $success ? "$room" : "" ; ?>"><br>

  <label for="instrument">ชื่ออุปกรณ์:</label>
  <input type="text" id="instrument" name="instrument" value="" placeholder="<?php echo $success ? "$instrument" : "" ; ?>"><br>

  <label for="quantity">จำนวน:</label>
  <input style="width: 150px;" type="number" id="quantity" name="quantity" value="" placeholder="<?php echo $success ? "$quantity" : "" ; ?>"><br>

  <label for="caretaker">ผู้ดูแล:</label>
  <input type="text" id="caretaker" name="caretaker" value="" placeholder="<?php echo $success ? "$caretaker" : "" ; ?>"><br>

  <label for="file">รูปภาพ:</label>
  <input type="file" id="file" name="file"><br><br>

  <div class="button"><button type="submit" value="Submit" name="submit">ส่งข้อมูล</button>&nbsp;&nbsp;<a class="back" href="index.php">ย้อนกลับ</a></div>
  
  
</form> 
</fieldset>

</body>
</html>