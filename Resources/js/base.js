// 背景图片
$.backstretch("/ss.jesslu/Resources/images/1.jpg");
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
	userInfo.find("img").attr("src","/ss.jesslu/Resources/images/userPic.jpg");
	userInfo.find(".userName").text("jesslu");
	userInfo.find(".userSign").text("我不是最好的，但我要是最努力的,只有努力才能有美好的明天");
	userInfo.find(".wenCnt").text("123");
	userInfo.find(".daCnt").text("13");
	userInfo.find(".shangCnt").text("23.00");
	userInfo.css({"top":top,"left":left}).show();
},function(){$("#userInfo").hide();});
// share
window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"2","bdPos":"right","bdTop":"100"},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
// 迷你编辑器
var Et;
var minEditHtm = "<div class='col-sm-12 edit-iframe bminEdit'><iframe id='bminEdit' name='bminEdit' frameborder='0' height='100%' width='100%' src='../../Public/minEdit/index.html'></iframe></div>";
$(".reply").click(function(){
	event.stopPropagation();
	$(".bminEdit").remove();
	$(this).after(minEditHtm);	
	Et =$("#minEdit").contents().find("#edit #edit-main .edit-edit .edit-text");
});
$("html").click(function(){
	$(".bminEdit").remove();
});

//滚动加载更多
// $(window).scroll(function(event){
	// var lastList = $(".list");
	// var jzTop = $("#foot").offset().top;
	// var jzH = $(".jiazai").height()
	// var wH = document.body.clientHeight;
	// var lastListScrTop = jzTop-wH;
	// if($(window).scrollTop()>lastListScrTop){
	// 	// clone(true)保留所有属性和事件
	// 	for (var i=0;i<5;i++){
	// 		var userArr = ["__ROOT__/Resources/images/userPic1.jpg","考考靠","2016-10-26 10:23","php",132,34];
	// 		lastList.eq(-1).before(lastList.eq(-1).clone(true)).show();
	// 		lastList.eq(-1).find("img").attr("src",userArr[0]);
	// 		lastList.eq(-1).find(".list-title a").text(userArr[1]);
	// 		lastList.eq(-1).find(".tm").text(userArr[2]);
	// 		lastList.eq(-1).find(".type").text(userArr[3]);			
	// 		lastList.eq(-1).find(".clickCnt").text(userArr[4]);			
	// 		lastList.eq(-1).find(".replyCnt").text(userArr[5]);			
	// 	}
	// }
// });

// 提示
function nt(content,type,tm){
	var obj = $("#nt");
	if(type==0){
		var color="#1abefb";
	}else{
		var color="#f0b144";
	}
	obj.text(content).css({"border":"1px solid "+color,"color":color}).show("slow").delay(tm).hide("slow");
}
//。。。
$(".user img").hover(function(){
	$(".user ul li ul").show();
});
$("body").click(function(){
	$(".user ul li ul").hide();
});
// 搜索页
$("#qMore").click(function(){
	$(".qList .list").show("slow");
	$(this).hide("slow");
});
$("#bMore").click(function(){
	$(".bList .list").show("slow");
	$(this).hide("slow");
});
//跳转到搜索页
$(".sosuo").click(function(){
	var key = $("input[name='key']").val().trim();
	if(key!=""){
		window.location = __ROOT__+"/Ss/index/key/"+key;
	}else{
		alert("请输入搜索词")	
	}
});
//按下Enter键搜索
$(document).on('keyup',function(e){
      if(e.keyCode === 13){
   		var frs = $("input[name='key']").is(":focus");
		if(frs){
			$(".sosuo").click();
		}
      }
});
