<?php

// 建立MySQL的資料庫連接 
$link = mysqli_connect("localhost","user","pwd","database");
                       
    if (mysqli_connect_errno($link)) 
    { 
        echo "連接 MySQL 失敗: " . mysqli_connect_error(); 
    } 


$sql = "SELECT name, email,time,bankid,bankname,bank,photo FROM wp_bankform";
$result = $link->query($sql);



header('content-type:text/html;charset=utf-8');
print <<<EOT
    <style type="text/css">
    table.gridtable {
        font-family: verdana,arial,sans-serif;
        font-size:15px;
        color:#333333;
        border-width: 1px;
        border-color: #666666;
        border-collapse: collapse;
        table-layout:fixed;
        width:95%;
        margin-top:40px; 
        margin-left:auto; 
        margin-right:auto;
    }
    table.gridtable th {
        border-width: 1px;
        padding: 2px;
        border-style: solid;
        border-color: #666666;
        background-color: #dedede;
    }
    table.gridtable td {
        border-width: 1px;
        padding: 10px;
        border-style: solid;
        border-color: #666666;
        background-color: #ffffff;
    }
    table.gridtable tr {
        text-align:center
    }
    </style> 

    <div style="text-align:center;margin:10 0 0 10">
    <table class="gridtable">
        <tr>
        <th>使用者名稱</th>
        <th>信箱</th>
        <th>銀行代碼</th>
        <th>戶名</th>
        <th>銀行帳戶</th>
        <th>時間</th>
        <th>照片</th>

        </tr>
EOT;
    while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["bankid"]."</td><td>".$row["bankname"]."</td><td>".$row["bank"]."</td><td>".$row["time"]."</td><td>"."<a target='_blank' href='".$row["photo"]."'/>查看照片</a></td>";
        echo "</tr>";
        //<td>"."<img width='100' height='100' src ='".$row["photo"]."'/></td>
    }
        echo "</table>";
        echo "</div>";
    $link->close();

    

?>



