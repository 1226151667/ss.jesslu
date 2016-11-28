$(".vote").click(function(){
	var obj = $(this);
	var type = obj.attr("name");
	var rs = 0;
	if(type=="up"){
		c=1;
	}else if(type=="down"){
		c=2;
	}else{
		rs=1;
		nt("操作失败",1,3000);
	}
	if(rs==0){
		var b = obj.parent().parent().parent().parent().attr("title");
		$.post(__ROOT__+'/Operate/vote',{t:1,b:b,c:c},function(data){
				nt(data[0],data[1],1500);	
				if(data[1]==0){
					var num = obj.text().trim();
					++num;
					obj.html("&nbsp;"+num);
				}		
		},"json");
	}
});