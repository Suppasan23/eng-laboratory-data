<?php
session_start();
?>

<?php
        $q = $_REQUEST["q"];

        $mysql = new mysqli("db","root","root","laboratory_system");
        if ($conn->connect_error){die("Connection failed: " . $conn->connect_error);}

        if ($q == "all")
        {
            $sql = "SELECT * FROM engineering_lab";
        
            if ($result = $mysql->query($sql)) 
            {
                while ($data = $result->fetch_object()) 
                {
                    $dataArgument[] = $data;
                }
            }
            printData($dataArgument);
        }
        else
        {
            $sql = "SELECT * FROM engineering_lab WHERE branch = '$q'";

            if ($result = $mysql->query($sql))
            {
                while ($data = $result->fetch_object())
                {
                    $dataArgument[] = $data;
                }
            }
            printData($dataArgument);
        }

        function printData($dataParameter)
        {
            echo "<table>";
            echo "<tr>";
            echo "<th style='width: 25px;'>ที่</th>";
            echo "<th>สาขา</th>";
            echo "<th>ห้อง</th>";
            echo "<th>อุปกรณ์</th>";
            echo "<th>จำนวน</th>";
            echo "<th>ผู้รับผิดชอบ</th>";
            echo "<th style='width: 250px;'>รูปภาพ</th>";
            if(isset($_SESSION['name'])) 
            {	
                echo "<th style='width: 78px;'><a class='additem' href='add.php'>เพิ่มข้อมูล</a></th>";
            }
            echo "</tr>";
                
            if(isset($dataParameter) && isset($dataParameter[0])) 
            {
                for($i=0; $i < count($dataParameter); $i++)
                {
                    echo "<tr>";
                    echo "<td>".($i+1)."</td>";
                    echo "<td>".$dataParameter[$i]->branch."</td>";
                    echo "<td>".$dataParameter[$i]->room."</td>";
                    echo "<td>".$dataParameter[$i]->instrument."</td>";
                    echo "<td>".$dataParameter[$i]->quantity."</td>";
                    echo "<td>".$dataParameter[$i]->caretaker."</td>";
                    echo "<td><img src='../picture/".$dataParameter[$i]->image."' width='250'></td>";

                    
                    if(isset($_SESSION['name'])) 
                    {		
                        $id = $dataParameter[$i]->id; 
                        echo "<td>
                                <a href='edit.php?key_id=".$id."'>แก้ไข</a> |
                                <a style = 'color:red'; href='delete.php?key_id=".$id."'>ลบ</a>
                            </td>";
                    }
                    echo "</tr>";
                }
            echo "</table>";
            } 
            else
            {
                echo "No data to display.";
            }
        }
?>
