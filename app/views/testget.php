<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<script type="text/javascript" src="jqs/jquery-3.2.1.min.js"></script>
	
	<script>
$(document).ready(function(){
	$("button").click(function(){
		$.get("http://localhost/AgeingAppDev-master/public/news",function(data,status){
			//alert("数据: " + data + "\n状态: " + status);
			$("#div1").load(data);
		});
	});
});
</script>
</head>
<body>
	<button>发送一个 HTTP GET 请求并获取返回结果</button>
	<div id="div1"></div>
</body>
</html>
