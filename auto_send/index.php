<?php
	require './mailer/class.phpmailer.php';
	require './mailer/class.smtp.php';
	date_default_timezone_set('PRC');
	//ignore_user_abort();
	define("URL","");
	define("URL2","");	
	//set_time_limit(0);
	//$interval = 60*5;
error_reporting(E_ALL ^ E_NOTICE); //不显示警告
function aveCard(){
   //邮件发送
    $url = ''; // 不限定内容类型，接口地址
	$data = array(
                'encode'=>'json'
            );
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 6);
    $response = curl_exec($ch);  
    if($error=curl_error($ch)){
        return '可恶，竟然失败了，F5刷新再试一下吧...'; // 如果6s内，接口调用失败则输出这个默认句子~
    }
    curl_close($ch);
    $array_data = json_decode($response,true);	   
	if(判断条件,如果达到了预定值则执行发送邮件)
{
		$mail = new PHPMailer(); 
		$mail->SMTPDebug = 3;
		$mail->isSMTP();
		$mail->SMTPAuth=true;
		$mail->Host = 'smtp.qq.com';
		$mail->SMTPSecure = 'ssl';
		//设置ssl连接smtp服务器的远程服务器端口号 可选465或587
		$mail->Port = 465;
		$mail->Hostname = 'localhost';
		$mail->CharSet = 'UTF-8';
		$mail->FromName = ''; //邮件主题
		$mail->Username ='';  //邮箱帐号
		$mail->Password = ''; //邮箱授权码
		$mail->From = '';  //发件人地址
		$mail->isHTML(true); 
		$mail->addAddress('','这个QQ的昵称');  //接收人地址	
		$mail->Subject = 'xxxxxxxx';  //邮件主题
		$mail->Body = "<p>xxxxxxxxxxxxxxxxxx<a href=".URL."><b style=\"color:red;\">xx</b></a>吧!</p>
		xxxxx：<a href=".URL2."><b style=\"color:red;\">点击查看</b></a>";  //邮件内容
		$mail->addAttachment('');
		$status = $mail->send();
		//sleep($interval);//CD为一个小时			
}
	else{
		return false;
}		
	/**if($status) 
	{
	 	echo '发送邮件成功'.date('Y-m-d H:i:s');;
	}
	else
	{
	 	echo '发送邮件失败，错误信息未：'.$mail->ErrorInfo;
	}*/
}	
echo aveCard();
?>

