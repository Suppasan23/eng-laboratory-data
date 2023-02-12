<?php 
session_start(); 
?>

 
 <?php
        $q = $_REQUEST["q"];

        $mysql = new mysqli("db","root","root","laboratory_system");

        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        } 

        if ($q == "all")
        {
            $tables = array("civil", "electrical", "mechanical", "industrial", "computer");
            $dataArgument = array();
            
            foreach ($tables as $table) 
            {
                $sql = "SELECT * FROM $table";
            
                if ($result = $mysql->query($sql)) 
                {
                    while ($data = $result->fetch_object()) 
                    {
                        $dataArgument[] = $data;
                    }
                }
            }
            printData($dataArgument);
        }
        else
        {
            $sql = "SELECT * FROM $q";

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
            echo "<th>ที่</th>";
            echo "<th>สาขา</th>";
            echo "<th>ห้อง</th>";
            echo "<th>อุปกรณ์</th>";
            echo "<th>จำนวน</th>";
            echo "<th>ผู้รับผิดชอบ</th>";
            echo "</tr>";
                
                for($i=0; $i < count($dataParameter); $i++)
                {
                    echo "<tr>";
                    echo "<td>".($i+1)."</td>";
                    echo "<td>".$dataParameter[$i]->branch."</td>";
                    echo "<td>".$dataParameter[$i]->room."</td>";
                    echo "<td>".$dataParameter[$i]->instrument."</td>";
                    echo "<td>".$dataParameter[$i]->quantity."</td>";
                    echo "<td>".$dataParameter[$i]->caretaker."</td>";

                    if(isset($_SESSION['name'])) 
                    {		
                        echo "<td>" . "<a onclick=ToDeletting($room_number,$id_number) style = 'color: #a40000; text-decoration: underline;cursor: pointer;'>แก้ไข</a>" . "</td>";	
                    }

                    echo "</tr>";
                }
                
            echo "</table>";
        }
?>


