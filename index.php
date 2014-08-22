<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Guess</title> 
 
    <style>
		
		.main{
		
		float:center;
		}
	
	
 	</style>
	
</head>
<body>

<div class="main" style="text-align:center">
 <h1>英语四六级分数查询</h1>
 
	
<form action="cet.php" method="GET"  id="form1" />
   
		姓名    ：<input type="text" name="name" id="name" /><br />
		准考证号：<input type="text" name="id" id="id" /><br />
		<input type="submit" value="submit"/>
</form>

  <br /> <br /> By NJTech GreenStudio<br /> <br />

 </div>

<script type="text/javascript">
String.prototype.trim = function () {
	return this.replace(/(\s*)|(\s*)/g, "");
}
document.getElementById("name").value="";
document.getElementById("id").value=""
document.getElementById("form1").onsubmit = function(){
	var name = document.getElementById("name");
	var id = document.getElementById("id");
	var yzm = document.getElementById("yzm");
	if(id.value.trim().length != 15){
		alert("请输入15位准考证号！");
		id.focus();
		return false;
	}
	if(name.value == ""){
		alert("请输入姓名！");
		name.focus()
		return false;
	}
	if(name.value.trim().length <1){
		alert("姓名不能少于1个字符！");
		name.focus()
		return false;
	}
	
}
</script>

</body>
</html>