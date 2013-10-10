<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php 
	if (!isset($_SESSION)) session_start();
	echo '欢迎光临禽兽潮！萌萌的'.$_SESSION['name'].'~'; 
?>
</body>
</html>