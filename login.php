<html>
<head>
	<script language="javascript" src="js/login.js"></script>
	<script language="javascript">	function RefreshCode(obj){ obj.src = "graph.php?code=" + Math.random(); } </script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<form name="log_user" method="post" action="login_check.php" target="_self">
<table width="400" height="150" " border="1" align="center" cellpadding="2" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#999999">
	<tr>	
		<td width="65" height="17">
			<div id="log_name" align ="right">用户名: </div>   
		</td>
		<td width="80" height="17">
			<div align="left">&nbsp; 
				<input id="log_name2" type="text" name="name" size="35" maxlength="50">
			</div>
		</td>
	</tr>
	
	<tr>
		<td width="50" height="17">	
			<div id="log_psw" align ="right">密&nbsp;&nbsp;码: </div>
		</td>
		<td width="80" height="17">
			<div align="left">&nbsp;
				<input id="log_psw2" type="password" name="psw" size="35" maxlength="50">
			</div>
		</td>
	</tr>
	
	<tr>
		<td width="50" height="50">
			<div id="log_code" align ="right">验证码: </div>
		</td>
		<td width="50" height="50">
			<div  align="left">&nbsp;
				<input id="log_code2" type="text" name="code" size="10">
				&nbsp;&nbsp;
				<img id="log_image" src="graph.php" width="100" height="30" onclick="RefreshCode(this)"/>
			</div>
		</td>
	</tr>
	
	<tr>
 		<td width="50" height="30">
 			<div align ="right"></div>
 		</td>
 		<td width="50">
 			<div align="left">
 				&nbsp;&nbsp;
 				<input id="log_submit" type="submit" name="submit" value="提交"/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input id="log_reset" type="reset" name="reset" value="重置"/>
			</div>
 		</td>
 	</tr>
	
</table>
</form>
</body>
</html>