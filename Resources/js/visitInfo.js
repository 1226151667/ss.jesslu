var v = window.location.href;
var f=document.referrer; //搜索来源页
var fA = f.split(".");
if(fA[1]!="jesslu"||fA[0]!="www"){
	var Form = getForm(f);
	$.post(__ROOT__+"/Visit/add",{fg:f,vg:v,k:Form[1],f:Form[0]},function(data){
	},"json");
}

//获取关键词
function checkStr(str,str1,str2){
  if(str != null || str1 != null || str2!=null){
    if(str != null){
      keyword=str.toString().split("=")[1].split("&")[0];
      return decodeURIComponent(keyword);
    }
    if(str2 != null){
      keyword=str.toString().split("=")[1].split("&")[0];
      return decodeURIComponent(keyword);
    }
    if(str1 != null){
      keyword=str1.toString().split("=")[1];
      return decodeURIComponent(keyword);
    }
  }else{
    return '未知';
  }
}
var grep=null;
var str=null;
var str1=null;
var str2=null;
var form=null;
var keyword=null;
function getForm(refer){
    if(refer!=""){
        var sosuo=refer.split(".")[1];
      switch(sosuo){
        case "baidu":
          form = "百度";
          grep=/wd\=.*\&/i;
          grep1=/wd\=.*/i;
          grep2=/word\=.*\&/i;
          str=refer.match(grep);
          str1=refer.match(grep1);
          str2=refer.match(grep2);
        break;
        case "google":
          form = "谷歌";
          grep=/q\=.*\&/i;
          grep1=/q\=.*/i;
          str=refer.match(grep);
          str1=refer.match(grep1);
        // console.log(document.referrer);
        break;
        case "sogou":
          form = "搜狗";
          grep=/query\=.*\&/i;
          grep1=/query\=.*/i;
          grep2=/keyword\=.*\&/i;
          str=refer.match(grep);
          str1=refer.match(grep1);
          str2=refer.match(grep2);
        break;
         case "soso":
          form = "搜搜";
          grep=/query\=.*\&/i;
          grep1=/query\=.*/i;
          grep2=/keyword\=.*\&/i;
          str=refer.match(grep);
          str1=refer.match(grep1);
          str2=refer.match(grep2);
        break;
        case "yahoo":
          form = "雅虎";
          grep=/p\=.*\&/i;
          grep1=/p\=.*/i;
          str=refer.match(grep);
          str1=refer.match(grep1);
        break;
          case "so":
          form = "360搜索";
          grep=/q\=.*\&/i;
          grep1=/q\=.*/i;
          str=refer.match(grep);
          str1=refer.match(grep1);
        break;
        default:
          form = "未知";
          grep=/query\=.*\&/i;
          grep1=/query\=.*/i;
          str=refer.match(grep);
          str1=refer.match(grep1);
        }
        keyword = checkStr(str,str1,str2);
    }else{
        form = "无来源";
        keyword = "无来源";
    }
    return [form,keyword];
}
