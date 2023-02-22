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
if(!isset($_SESSION['name'])) {
	echo "<h3>ท่านยังไม่ได้ทำการล็อคอิน</h3>";
	Close();
	}

if(!isset($_GET['action'])) {
    echo "<h3>กระบวนการไม่ถูกต้อง</h3>";
    Close();
    }

if(!isset($_GET['table'])) {
	echo "<h3>กระบวนการไม่ถูกต้อง</h3>";
	Close();
	}

if(!isset($_GET['id'])) {
	echo "<h3>กระบวนการไม่ถูกต้อง</h3>";
	Close();
	}


if(isset($_GET['action']))
{
    $action = $_GET['action'];
    $table = $_GET['table'];
    $id = $_GET['id'];

    $conn = new mysqli("db","root","root","laboratory_system");
	if ($conn->connect_error){die("Connection failed: " . $conn->connect_error);}// Check connection

    if($action == "delete") //ถ้าเป็นการลบ ก็นำค่า id ไปกำหนดเป็นเงื่อนไขการลบ
    {
        $sql = "DELETE FROM $table WHERE id = $id";
        $delete = mysqli_query($conn , $sql);
        if(!$delete)
            {
                echo mysqli_error($conn);
            }
            else
            {
                echo "<h3>ข้อมูลถูกลบแล้ว</h3>";
                header("refresh: 1; url=index.php");
            }
    }
    else if($action == "delete") //ถ้าเป็นการแก้ไขข้อมูล ต้องอ่านข้อมูลเดิมมาเติมลงในฟอร์ม
    {
        
    }
}

