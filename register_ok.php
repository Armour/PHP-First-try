<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php

	function hashit($a) 
	{
		$salt="GC_ZXCVBN";  	//salt值
		$b=$a.$salt;  			//把密码和salt连接
		$b=md5($b);  			//执行MD5散列
		return $b;  			
	}
	
	function check_input($value)
	{
		// 去除斜杠
		if (get_magic_quotes_gpc())
		{
			$value = stripslashes($value);
		}
		
		// 防sql注入
		$value = mysql_real_escape_string($value);
		return $value;
	}

	session_start();
	
	//如果验证码正确则执行操作
	if ($_SESSION["checkcode"] == $_POST[code])
	{	
		//防sql注入
		$name = check_input($_POST[name]);
		$psw = check_input($_POST[psw]);
		
		//md5加盐 加密
		$new_psw = hashit($psw);
		
		//连接数据库
		$link = mysql_connect('localhost', 'gc', 'oioi');
		if (!$link)
		{
			die('Could not connect: ' . mysql_error());
		}
		mysql_query("set names 'utf8'",$link);
		mysql_query("use db_reglog",$link);	
		
		//判断是否已经存在此用户名
		$query = "select * from tb_member where name='$name'";
		$result = mysql_query($query,$link)or die(mysql_error());
		$num = mysql_num_rows($result);
		if ($num>0) 
		{
			echo "<script language='JavaScript'> alert('已存在此用户名');</script>";
			echo "<script>window.location.href='register.php';</script>";
		};
		
		//添加新用户数据
		$query ="insert into tb_member(name,psw,realname,sex,IDcard,gtel,mtel,email,home)	
			 	values('$name','$new_psw','$_POST[realname]','$_POST[sex]','$_POST[IDcard]',
			 	  	   '$_POST[gtel]','$_POST[mtel]','$_POST[email]','$_POST[home]')";
		$result =mysql_query($query,$link);
 		mysql_close($link);
	}	else
		
	// 如果验证码不正确则弹出提示并返回注册页面 
	{
		echo "<script language='JavaScript'> alert('验证码错误');</script>";
		echo "<script>window.location.href='register.php';</script>";
	}
?>
<a href="login.php"> 注册成功！轻戳进入登录界面 ~ </a>
</body>
</html>
