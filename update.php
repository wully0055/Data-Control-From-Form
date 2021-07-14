<?php

$name = $_POST["name"];
$account = $_POST["account"];
$email = $_POST["email"];
$time = $_POST["time"];
$bankid = $_POST["bankid"];
$bankname	= $_POST["bankname"];
$bank = $_POST["bank"];

header("Content-type: text/html; charset=utf-8");
$oldPath=$_FILES['my_file']['tmp_name'];//臨時資料夾,即以前的路徑
$fileName=$_FILES['my_file']['name'];
$file = new SplFileInfo($fileName);//找副檔名

$extension  = $file->getExtension();
$oldPath_name=time().'.'.$extension;//改名成時間戳

if(in_array($extension,array('jpg','png','gif'))){//檢查檔案副檔名

  $store_dir = "upload/";
  echo "<script> {window.alert('上傳成功');top.location.href='https://www.plantmeat.com.tw/'} </script>";
}else{

  echo "<script> {window.alert('上傳失敗，不允許該檔案格式');top.location.href='https://www.plantmeat.com.tw/index.php/%e4%b8%8a%e5%82%b3/'} </script>";
  
}

if(!move_uploaded_file($oldPath,$store_dir.$oldPath_name)){ //上傳

  echo "";
  exit;
}else{
  echo "";
 
}

if(in_array($extension,array('jpg','png','gif'))){//檢查檔案副檔名

  // 建立MySQL的資料庫連接 
  $link = mysqli_connect("localhost","user","pwd","database");
  
  if (mysqli_connect_errno($link)) 
  { 
      echo "連接 MySQL 失敗: " . mysqli_connect_error(); 
   
  
      $file = "https://www.plantmeat.com.tw/wordpress/upload/" . $oldPath_name;
      $sql = "INSERT INTO `wp_bankform`(`name`, `email`, `time`,`photo`,`bankid`,`bankname`,`bank`) VALUES (\"$name\",\"$email\",\"$time\",\"$file\",\"$bankid\",\"$bankname\",\"$bank\")"; // 指定SQL字串
      //echo "SQL字串: $sql <br/>";
      //送出UTF8編碼的MySQL指令
      mysqli_query($link, 'SET NAMES utf8'); 
      mysqli_query($link, $sql);

      //Post 到 mail  
      $curl=curl_init();
      $url="https://mail.weeshopstyle.com/send_email/mail.php";
      curl_setopt($curl, CURLOPT_URL,$url);
      curl_setopt($curl, CURLOPT_POST, true);  //設定請求為post
      $post_data=array('name'=>"$name",'email'=>"$email",'time'=>"$time",'photo'=>"$file",'bankid'=>"$bankid",'bankname'=>"$bankname",'bank'=>"$bank");   //要傳送的資料組裝成一個數組
      curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);  //post的資料內容
      curl_exec($curl); 
      curl_close($curl);

  }else{

  
  }
  
?>
