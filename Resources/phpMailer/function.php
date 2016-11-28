<?php
function postmail($to,$subject = '',$body = '',$info=''){
	//Author:Jiucool WebSite: http://www.jiucool.com
	//$to 表示收件人地址 $subject 表示邮件标题 $body表示邮件正文
	//error_reporting(E_ALL);
	error_reporting(E_STRICT);
// 	date_default_timezone_set('Asia/Shanghai');//设定时区东八区
	require_once('./Resources/phpMailer/class.phpmailer.php');
	include_once('./Resources/phpMailer/class.smtp.php');
	$body = '<div style="width:50%;height:auto;margin:0 auto;font-size:14px;border:1px solid #6dcafb;">
		<div style="height:50px;background:#6dcafb;color:#eee;text-align:center;line-height:50px;font-size:16px;">欢迎来到捷搜索-专供技术的问答社区和技术博客</div>
		<div style="height:auto;padding:15px;">'.$body.'</div>
		<div style="height:40px;background:#adadad;color:eee;line-height:40px;text-align:center;">
			感谢您使用捷搜索（http://www.jsosuo.com），如有疑问或意见请反馈我们，我们的联系邮箱是jsosuo@163.com
		</div>
		</div>';
	$mail             = new PHPMailer(); //new一个PHPMailer对象出来
	$body            = eregi_replace("[\]",'',$body); //对邮件内容进行必要的过滤
	$mail->CharSet ="utf-8";//设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
	$mail->IsSMTP(); // 设定使用SMTP服务
	$mail->SMTPDebug  = 1;                   // 启用SMTP调试功能
	// 1 = errors and messages
	// 2 = messages only
	$mail->SMTPAuth   = true;                // 启用 SMTP 验证功能
	// $mail->SMTPSecure = "ssl";               // 安全协议，可以注释掉
	$mail->Helo = "这是捷思路的邮件";
	$mail->Host       = "smtp.163.com";      // SMTP 服务器
	$mail->Port       = 25;      // SMTP服务器的端口号
	$mail->Username   = "jsosuo@163.com";  //发件人邮箱
	$mail->Password   = "dljsosuo1234";  //发件人邮箱密码
	$mail->SetFrom("jsosuo@163.com", "捷搜索");
	$mail->AddReplyTo("jsosuo@163.com", "捷搜索");
	$mail->Subject    = $subject;
	$mail->AltBody    = 'To view the message, please use an HTML compatible email viewer!'; // optional, comment out and test
	$mail->MsgHTML($body);
	$address = $to;
	$mail->AddAddress($to, '');
	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
	if(!$mail->Send()) {
		return 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		return "ok";
	}
}