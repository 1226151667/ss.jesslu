// 投票(t:1/2->回答/文章)
$(".vote").click(function(){
	var obj = $(this);
	var t = parseInt(obj.attr("type"));
	var oper = obj.attr("name");
	var rs = 0;
	if(oper=="up"){
		c=1;
	}else if(oper=="down"){
		c=2;
	}else{
		rs=1;
		nt("数据错误",1,3000);
	}
	if(t==1){
			var b = obj.parent().parent().parent().parent().attr("title");
	}else if(t==2){
			var b = obj.parent().attr("title");
	}else{
		rs=1;
		nt("数据错误",1,3000);
	}
	if(rs==0){
		$.post(__ROOT__+'/Operate/vote',{t:t,b:b,c:c},function(data){
				nt(data[0],data[1],1500);	
				if(data[1]==0){
					var num = obj.text().trim();
					++num;
					obj.html("&nbsp;"+num);
				}		
		},"json");
	}
});
//回答、问题、文章提交
$(".edit-sub").click(function(){
	var type = $(this).attr("id");
	var cL = ue.getContentTxt().length;
	var c = ue.getContent();
	// var c = ue.getPlainTxt();
	if(type==3){
		if(cL<10){
			alert('内容不得少于10个字符')
		}else{
			var q = $(this).attr("qId");
			$.post(__ROOT__+'/Edit/add',{type:3,q:q,c:c},function(data){
				alert(data[0]);
			},"json");
		}
	}else if(type==1){
		var t = $('select[name="t"]').val();
		var tt = $('input[name="tt"]').val();
		if(tt.length>40||tt.length<5){
			alert('标题长度:[5,40]');
		}else if(cL<30||cL>10000){
			alert('正文长度:[30,10000]');
		}else{
			$.post(__ROOT__+'/Edit/add',{type:1,tt:tt,t:t,c:c},function(data){
				alert(data[0]);
			},"json");
		}
	}else if(type==2){
		var t = $('select[name="t"]').val();
		var tt = $('input[name="tt"]').val();
		if(tt.length>40||tt.length<5){
			alert('标题长度:[5,40]');
		}else if(cL<500||cL>10000){
			alert('正文长度:[500,10000]');
		}else{
			$.post(__ROOT__+'/Edit/add',{type:2,tt:tt,t:t,c:c},function(data){
				alert(data[0]);
			},"json");
		}
	}else{
		alert('数据出错，请刷新后再试')
	}
});