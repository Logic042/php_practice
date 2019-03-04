function show_time()
{
	
	var now=new Date();
	var year=now.getFullYear();
	var month=now.getMonth()+1;
	var date=now.getDate();
	var day=now.getDay();
	var hour=now.getHours();
	var minute=now.getMinutes();
	var second=now.getSeconds();
	var arr_week=new Array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
	var week=arr_week[day];
	var show_T=year+"年"+month+"月"+date+"日"+week+"&nbsp"+hour+":"+minute+":"+second;
	name1=document.getElementById("show_ti");
	name1.innerHTML="当前时间:"+show_T;
}
setInterval("show_time()",1000); 
function showSome()
{
	//alert("hello,world");
	name1=document.getElementById("show_ti");
	name1.innerHTML="hello";
	name1.style="display:show";
}
