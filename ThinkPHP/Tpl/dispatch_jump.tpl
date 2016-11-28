<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{font-family: '微软雅黑';color:#6dcafb;font-size: 16px;}
.system-message{height:auto;width:80%;margin:auto;margin-top:100px;border:1px solid #6dcafb;border-radius:10px;text-align: center;padding: 10px;}
/*.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }*/
.system-message a{color:#2ad;}
.system-message .error{font-size:20px;color:red;}
.system-message .success{font-size:20px;color:#2ad;}
</style>
</head>
<body>
<div class="system-message">
	<present name="message">
	<!-- <h1>:)</h1> -->
	<span class="success"><?php echo($message); ?></span>
	<else/>
	<!-- <h1>:(</h1> -->
	<span class="error"><?php echo($error); ?></span>
	</present>
	<span class="detail"></span>
	<span class="jump">
	页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
	</span>&nbsp;&nbsp;
	<span id="foot">------------欢迎访问<a href="http://www.jsosuo.com">捷搜索</a></span>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>