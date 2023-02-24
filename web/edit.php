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
if(isset($_SESSION['name'])) 
{
    $key_id = $_GET['key_id'];

    $conn = new mysqli("db","root","root","laboratory_system");// Create connection
    if ($conn->connect_error){die("Connection failed: " . $conn->connect_error);}// Check connection

    $sql = "SELECT * FROM engineering_lab WHERE id = $key_id";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
    mysqli_close($conn);
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
    if($_FILES['new_pic'])
    {
        $file = $_FILES['new_pic'];

        // file properties
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];

        // get file extension
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        // allowed extensions
        $allowed = array('jpg', 'jpeg', 'png', 'gif', 'webp');

        if(in_array($file_ext, $allowed)) 
        {
            if($file_error === 0)
            {
                if($file_size <= 5000000) 
                {
                    // create new unique file name to avoid overwrite
                    $new_file_name = uniqid('', true) . '.' . $file_ext;

                    // file directory
                    $file_destination = '../picture/' . $new_file_name;

                    if (move_uploaded_file($file_tmp, $file_destination))
                    {

                        replace_to_database($new_file_name);

                    }
                    else {echo "Failed to save the image.";}
                } 
                else {echo "File size is too large.";}
            } 
            else {echo "Error uploading file.";}
        } 
        else {echo "ต้องใส่ไฟล์รูปภาพที่มีนามสกุล 'jpg', 'jpeg', 'png', 'gif' หรือ 'webp' เท่านั้น";}
    }
    else
    {

        $old_file_name = $_POST['old_pic'];
        replace_to_database($old_file_name);

    }
}
?>

<?php
function replace_to_database($image_name_parameter)
    {
        $id = $_POST['id'];
        $branch = $_POST['branch'];
        $room = $_POST['room'];
        $instrument = $_POST['instrument'];
        $quantity = $_POST['quantity'];
        $caretaker = $_POST['caretaker'];
        $image = $image_name_parameter;
    
        $conn = new mysqli("db","root","root","laboratory_system");// Create connection
        if ($conn->connect_error){die("Connection failed: " . $conn->connect_error);}// Check connection
    
        $sql = "REPLACE INTO engineering_lab (id, branch, room, instrument, quantity, caretaker, image)
        VALUES ('$id', '$branch', '$room', '$instrument', '$quantity', '$caretaker', '$image');";
    
        $replace = mysqli_query($conn,$sql);
    
        if(!$replace)
        {
            echo "<h3 style = 'color:red'>การเพิ่มข้อมูล เกิดข้อผิดพลาด</h3>";
            echo mysqli_error($conn);
            mysqli_close($conn);
        }
        else
        {
            $show_id = mysqli_insert_id($conn); 
    
            $sql = "SELECT * FROM engineering_lab WHERE id = $show_id";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_array($result);
            mysqli_close($conn);
    
            echo "<h3 style = 'color:green'>ข้อมูลถูกแก้ไขแล้ว</h3>";
            back();
        }
    }
?>

<?php
function back()
{
    $data = "";
    header("refresh: 1.5; url=index.php");
}
?>

<fieldset><legend>แก้ไขข้อมูล</legend>
<form method="POST" enctype="multipart/form-data">

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

  <!--รูปก่า-->
  <label for="old_pic">รูปภาพ:</label>
  &nbsp;<img src="<?php echo $success ? "-" : '../picture/'.$data["image"]; ?>" width="200" style="display: inline-block; vertical-align: top;"><br>
  <input type="hidden" id="old_pic" name="old_pic" value="<?php echo $success ? "" : $data['image'] ; ?>" readonly>

  <!--รูปใหม่-->
  <label for="new_pic">เปลี่ยนรูป:</label>
  <input type="file" id="new_pic" name="new_pic"><br><br>

  <div class="button"><button type="submit" value="Submit">ส่งข้อมูล</button>&nbsp;&nbsp;<a class="back" href="index.php">ย้อนกลับ</a></div>
  
</form> 
</fieldset>

</body>
</html>