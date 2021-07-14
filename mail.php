<?php

$name = $_POST["name"];
$account = $_POST["account"];
$email = $_POST["email"];
$time = $_POST["time"];
$bankid = $_POST["bankid"];
$bankname = $_POST["bankname"];
$bank = $_POST["bank"];
$file = $_POST["photo"];

  
require '../vendor/autoload.php';
use Mailgun\Mailgun;
# Instantiate the client.
date_default_timezone_set("Asia/Taipei");

$mgClient = new Mailgun('your API code');
$domain = "mail.weeshopstyle.com";

$validationUrl = "https://mail.weeshopstyle.com/send_email/Verification_Email.php?email_key={$mail_key}&type={$type}";

if ($email != "") {
    $result = 
	$mgClient->sendMessage($domain, array(
        'from' => '趙元館 <support@mail.circlecan33.com>','to' =>"{$name} <{$email}>",'subject' => 
        "趙元館 會員資料表單自動回覆 <<請勿直接回覆>>",'html' =>
		"
<h3>
親愛的 $name 您好，<br/>
感謝您在趙元館官網填寫表單!<br/>
請確認下方資料是否正確，謝謝!<br/><br/><br/>
使用者名稱：$name<br/>
信箱：$email<br/>
銀行代碼：$bankid<br/>
戶名：$bankname<br/>
銀行帳戶：$bank<br/>
填寫日期：$time<br/>
圖片資料：$file<br/><br/><br/>


## 請勿直接回覆 ##<br/><br/><br/>

</h3>
"
    ));
    if ($result->http_response_code == 200 || $result->http_response_code == '200') {
        //echo 成功;
    } else {
        //echo 失敗;
    }

    // print_r($result);
} else {
    echo "無效的電子郵件";
}



?>