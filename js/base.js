// 背景图片
$.backstretch("images/1.jpg");
// 导航栏
$("#pcNav ul li").hover(function(){
	$(this).css({"background":"#6c6c6c"});
	$(this).find("a").css("color","white");
},function(){
	$(this).css("background","transparent");
	$(this).find("a").css("color","#9d9d9d");
});
// 搜索
$(window).scroll(function(event){
	var ss = $("#sosuo");
	var wW = $(window).width();
	if(wW>768)var s = 100;
	else var s = 50;
	if($(window).scrollTop()>s)
	ss.css({"position":"fixed","top":"0px","left":"0px","width":"100%","z-index":"99"});
	else
	ss.css({"position":"relative","z-index":"1"});
});
//回到顶部
$("#backTop").click(function(){
	$("html,body").animate({"scrollTop":"0"},300);
});
//动态加载
$(window).scroll(function(event){
	if($(window).scrollTop()>1000){
		$("#backTop").show();
	}else{
		$("#backTop").hide();
	}
});
// 用户详情
$(".userPic").hover(function(){
	var userInfo = $("#userInfo");
	var top = $(this).offset().top;
	var left = $(this).offset().left;
	var uH = userInfo.height();
	top = top-uH-20;
	userInfo.find("img").attr("src","images/userPic.jpg");
	userInfo.find(".userName").text("jesslu");
	userInfo.find(".userSign").text("我不是最好的，但我要是最努力的,只有努力才能有美好的明天");
	userInfo.find(".wenCnt").text("123");
	userInfo.find(".daCnt").text("13");
	userInfo.find(".shangCnt").text("23.00");
	userInfo.css({"top":top,"left":left}).show();
},function(){$("#userInfo").hide();});
// share
window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"2","bdPos":"right","bdTop":"100"},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];