<?php 
session_start(); 
?>

<!DOCTYPE html>

<head>
<title>Engineering Laboratory</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="header">
    <div class="header-one"><img src="..\picture\universitylogo.png" alt="universitylogo" width="30" height="52"></div>
    <div class="header-two"><a class="header">ระบบข้อมูลห้องปฏบัติการคณะวิศวกรรมศาสตร์ (Engineering Laboratory)</a></div>
    <div class="login">

        <?php 
            if(!isset($_SESSION['name']))  /*ไม่ได้ล็อคอิน*/
            {
                echo "<a class='notlogin' href='login.php'>Login</a>";
            }
            else/*ล็อคอินแล้ว*/
            {
                echo "<a class='additem' id='additem'>เพิ่มข้อมูล</a><br/>";
                echo "<a class='logined'  href='logout.php'>Logout</a>";
            }
        ?>

    </div>
</div>

<div class="body">
    <div class="body-one" id="myButton">
        <button class="btnA active" type="button" value="all">ทั้งหมด</button><br/>
        <button class="btn" type="button" value="civil">วิศวกรรมโยธา</button><br/>
        <button class="btn" type="button" value="electrical">วิศวกรรมไฟฟ้า</button><br/>
        <button class="btn" type="button" value="mechanical">วิศวกรรมเครื่องกล</button><br/>
        <button class="btn" type="button" value="industrial">วิศวกรรมอุตสาหการ</button><br/>
        <button class="btn" type="button" value="computer">วิศวกรรมคอมพิวเตอร์</button><br/>
    </div>

    <div class="body-two">
        <a class="data" id="data"></a>
    </div>

</div>

<script src="javascript.js"></script>
</body>
</html>
