<?php
	$_SESSION['come_from'] = HTTP_PWD;
	$logged = $_SESSION['logged'];
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<nav>
			<?php
				if($logged){
			?>
					<a href="<?php echo HTTP_PWD . '/add_site'; ?>" > Add </a>
			<?php
				}
			?>
			<?php if($_SESSION['logged'] === true){ ?>
				<a href="<?php echo HTTP_PWD . '/logout'; ?>" > Loggout </a>
			<?php }else{ ?>
				<a href="<?php echo HTTP_PWD . '/login'; ?>"> Login </a>
			<?php } ?>
		</nav>

		<h1>Httpstatus</h1>
		<h2>Justin Sella, Arnaud Dauguen </h2>
