// 设置常量
var __ROOT__ = 'http://localhost/ss.jesslu/Jadmin.php';
// 头像管理
$("#Icon .glyphicon-remove").click(function(){
	if(confirm("您确定删除这个头像")){
		var iconId = $(this).parent().parent().attr("id");
		$.get(__ROOT__+'/Icon/del',{id:iconId},function(data){
			alert(data);
			location.reload();
		},"json");
	}
});
// 类别管理
// 添加
$("#typeSub").click(function(){
	var ne = $("input[name='name']").val().trim();
	var de = $("textarea[name='description']").val().trim();
	var pd = $("select[name='pId']").val();
	var st = $("input[name='state']").val();
	if(ne==""||de==""){
		alert("输入不能有空");
	}else if(ne.length<1 || ne.length>10){
		alert("名称字符长度要介于1-10个之间");
	}else if(de.length<20 || de.length>100){
		alert("简介字符长度要介于20-100个之间");
	}else{
		$.post(__ROOT__+"/Type/add",{ne:ne,de:de,pd:pd,st:st},function(data){
			alert(data[1]);
			if(data[0]==0){
				location.reload();
			}
		},"json");
	}
});
// 删除
$("#Type .glyphicon-remove").click(function(data){
	if(confirm("您确定删除这个头像")){
		var tId = $(this).parent().parent().attr("id");
		$.get(__ROOT__+'/Type/del',{id:tId},function(data){
			alert(data);
			location.reload();
		},"json");
	}
});