// $("#login .sub").click(function(){
// 	$.get(__ROOT__+'/Login/setS',{id:2},function(data){
// 		alert(data);
// 		window.location("localhost/ss.jesslu");
// 	},"json");
// });
$("#Register .sub").click(function(){
	var e = $("input[name='email']").val().trim();
	var p1 = $("input[name='pwd1']").val().trim();
	var p2 = $("input[name='pwd2']").val().trim();
	var t = $("input[type='checkbox']").is(":checked");
	if(e=="" || p1=="" || p2==""){
		alert("输入不能有空");
	}else if(p1!=p2){
		alert("两次密码输入不一致");
		$("input[name='pwd1']").focus();
	}else if(!e.match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/)){
   		alert("邮箱格式不正确！");
   		$("input[name='email']").focus();
  	}else if(p1.length<6 || p1.length>15){
  		alert("密码长度[6,15]");
  		$("input[name='pwd1']").focus();
  	}else if(t){
  		$.post(__ROOT__+'/Register/get',{e:e,p1:p1,p2:p2},function(data){
  			if(data[0]==0){
  				window.location = __ROOT__+"/Email/index/state/"+data[1]+"/jssid/"+data[2];
  			}else{
  				alert(data[1]);			
  			}
  		},"json");
  	}else{
  		alert("必须勾选‘我已阅读并同意服务条款’");
  	}
});

$("#login .sub").click(function(){
	var e = $("input[name='email']").val().trim();
	var p = $("input[name='pwd']").val().trim();
	if(e=="" || p==""){
		alert("输入不能有空");
	}else if(!e.match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/)){
		alert("邮箱格式不正确！");
   		$("input[name='email']").focus();
	}else if(p.length<6 || p.length>15){
		alert("密码长度[6,15]");
  		$("input[name='pwd']").focus();
	}else{
		$.post(__ROOT__+'/Login/check',{e:e,p:p},function(data){
  			if(data[0]==0){
  				window.location = __ROOT__;
  			}else{
  				alert(data[1]);			
  			}
  		},"json");
	}
});