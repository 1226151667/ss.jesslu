$(function(){
var fIL = $(".face-icon-list");
var eDt = $(".edit-text");
var nt = $(".edit-notice");
$(".face-icon").click(function(){
	var isShow = fIL.css("display");
	if(isShow=="none"){
		fIL.show();	
	}else{
		fIL.hide();
	}
});
eDt.keydown(function(){
	updateS();
});
eDt.focus(function(){
	fIL.hide();
});
fIL.find("td img").click(function(){
	var imgText = $(this).attr("alt");
	var contentHtm = eDt.val();
	fIL.hide();
	eDt.focus();
	eDt.val(contentHtm+imgText);
},updateS());
$(".edit-sub").click(function(){
	var contentHtm = eDt.val().trim();
	var strT = $(".str-length i").text();
	if(contentHtm==""){
		ntShow("输入不能为空");
	}else if(contentHtm.length>strT){
		ntShow("不能超过"+strT+"个字符");
	}else{
		var contentHtm = iconReplace(contentHtm);
		ntShow("发送成功",1);
	}
});
//提醒显示
function ntShow(content,type=0){
	if(type==0){
		color = "#ff2d2d";
	}else{
		color = "#2ad";
	}
	nt.text(content).css({"color":color,"border":"1px solid "+color}).fadeIn("slow").delay(2000).fadeOut("slow");
}
//计算字符长度
function updateS(){
	var strL = eDt.val().trim().length;
	$(".str-length strong").text(strL);
}
//替换
function iconReplace(s){
	if(typeof(s)!="undefined"){
		var sArr = s.match(/\[.*?\]/g);
		if(sArr!=null && sArr!=""){
			// $.unique(sArr);
			iconArr = getIconArr();
			for(var i=0;i<sArr.length;i++){
				if(typeof(iconArr[sArr[i]])!="undefined"){
					var alt = sArr[i].replace(/\[|\]/g,"");
					var reStr = '<img src="'+ iconArr[sArr[i]] +'" title="'+ alt +'" alt="'+ alt +'" width="22" height="22">';
					var reg = new RegExp(sArr[i], "g");
					s = s.replace(sArr[i],reStr);
				}
			}
		}
	}
	return s;
}

//获得所有表情数组
function getIconArr(){
	var iconArr = {};
	var obj = fIL.find("td img");
	$(obj).each(function(i,v){
		var key = $(v).attr("alt");
		var val = $(v).attr("src");
		iconArr[key]=val;
	});
	return iconArr;
}
});