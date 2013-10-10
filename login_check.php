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
	
	if (!isset($_SESSION)) session_start();
	
	//如果验证码正确则执行操作
	if ($_SESSION["checkcode"] == $_POST["code"])
	{

		//防sql注入
		$name = check_input($_POST["name"]);
		
		//md5加盐 加密
		$psw = hashit($_POST["psw"]);
		
		//连接数据库
		$link = mysql_connect('localhost', 'gc', 'oioi');
		if (!$link)
		{
			die('Could not connect: ' . mysql_error());
		}
		//选择数据库
		$query = "use db_reglog";
		$result = mysql_query($query,$link);
		
		//执行数据库查询判断是否有此用户名
		$query = "select * from tb_member where name='$name'";
		$result = mysql_query($query,$link)or die(mysql_error());
		$num = mysql_num_rows($result);
		
		//用户名存在
		if ($num>0) 
		{
			//执行数据库查询判断是否密码正确
			$query = "select * from tb_member where name='$name' and psw='$psw'";
			$result = mysql_query($query,$link)or die(mysql_error());
			$num = mysql_num_rows($result);
			
			//密码正确
			if ($num>0)
			{
				$_SESSION['name'] = $_POST['name'];
				include 'qsc.php';
			} else 
			{
				echo "<script type='text/javascript'> alert('密码错误');</script>";
				echo "<script>window.location.href='login.php';</script>";
			};	
		} else 
			
		//不存在此用户名  返回初始界面选择注册或登录
		{
			echo "<script type='text/javascript'>  alert('此用户名不存在');</script>";
			echo "<script>window.location.href='Start.php';</script>";
		};
	} else
		
	//如果验证码不正确则弹出提示并返回登录页面 
	{
		echo "<script language='JavaScript'> alert('验证码错误');</script>";
		echo "<script>window.location.href='login.php';</script>";
	};
?>
</body>
</html>
